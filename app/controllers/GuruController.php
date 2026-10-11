<?php
/**
 * Guru Controller
 * Handles Teacher Portal: Dashboard, Jadwal Mengajar, Input & Kelola Nilai Siswa
 */

require_once __DIR__ . '/../core/Controller.php';

class GuruController extends Controller {

    public function __construct() {
        requireRole('guru');
    }

    /**
     * Map current PHP day of week (1=Monday...7=Sunday) to Indonesian name
     */
    private function getIndonesianDay(): string {
        $dayNum = date('N');
        $map = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];
        return $map[$dayNum] ?? 'Senin';
    }

    /**
     * Dashboard Guru
     */
    public function dashboard() {
        $guruId = (int)$_SESSION['user_id'];
        $jadwalModel = $this->model('Jadwal');
        $nilaiModel = $this->model('Nilai');
        $guruModel = $this->model('Guru');

        $guru = $guruModel->getById($guruId);
        $hariIni = $this->getIndonesianDay();

        $jadwalHariIni = $jadwalModel->getTodayByGuru($guruId, $hariIni);
        $allJadwal = $jadwalModel->getByGuruId($guruId);
        $classes = $jadwalModel->getClassesByGuru($guruId);
        $subjects = $jadwalModel->getSubjectsByGuru($guruId);
        $recentNilai = array_slice($nilaiModel->getByGuruId($guruId), 0, 5);

        $this->view('guru/dashboard', [
            'title' => 'Dashboard Guru',
            'guru' => $guru,
            'hariIni' => $hariIni,
            'jadwalHariIni' => $jadwalHariIni,
            'totalJadwal' => count($allJadwal),
            'totalKelas' => count($classes),
            'totalMapel' => count($subjects),
            'totalNilai' => count($nilaiModel->getByGuruId($guruId)),
            'recentNilai' => $recentNilai
        ]);
    }

    /**
     * Jadwal Mengajar Guru
     */
    public function jadwal() {
        $guruId = (int)$_SESSION['user_id'];
        $jadwalModel = $this->model('Jadwal');

        $jadwalList = $jadwalModel->getByGuruId($guruId);
        $hariIni = $this->getIndonesianDay();

        // Group schedules by day
        $grouped = [];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        foreach ($days as $d) {
            $grouped[$d] = [];
        }
        foreach ($jadwalList as $j) {
            $grouped[$j['hari']][] = $j;
        }

        $this->view('guru/jadwal', [
            'title' => 'Jadwal Mengajar Saya',
            'groupedJadwal' => $grouped,
            'hariIni' => $hariIni,
            'totalJadwal' => count($jadwalList)
        ]);
    }

    /**
     * Halaman Input & Kelola Nilai
     */
    public function nilai() {
        $guruId = (int)$_SESSION['user_id'];
        $jadwalModel = $this->model('Jadwal');
        $nilaiModel = $this->model('Nilai');
        $kelasModel = $this->model('Kelas');
        $pelajaranModel = $this->model('Pelajaran');

        // Teacher's classes and subjects
        $classes = $jadwalModel->getClassesByGuru($guruId);
        if (empty($classes)) {
            // Fallback to all classes if no schedule yet assigned
            $classes = $kelasModel->getAll();
        }

        $subjects = $jadwalModel->getSubjectsByGuru($guruId);
        if (empty($subjects)) {
            // Fallback to all subjects
            $subjects = $pelajaranModel->getAll();
        }

        // Active filter
        $selectedKelasId = isset($_GET['id_kelas']) ? (int)$_GET['id_kelas'] : ($classes[0]['id_kelas'] ?? 0);
        $selectedPelajaranId = isset($_GET['pelajaran_id']) ? (int)$_GET['pelajaran_id'] : ($subjects[0]['pelajaran_id'] ?? 0);

        // Fetch students and current grades for this class and subject
        $studentsWithGrades = [];
        if ($selectedKelasId && $selectedPelajaranId) {
            $studentsWithGrades = $nilaiModel->getByKelasAndPelajaran($selectedKelasId, $selectedPelajaranId);
        }

        // List of all grades inputted by this teacher
        $historyNilai = $nilaiModel->getByGuruId($guruId);

        $this->view('guru/nilai', [
            'title' => 'Kelola Nilai Siswa',
            'classes' => $classes,
            'subjects' => $subjects,
            'selectedKelasId' => $selectedKelasId,
            'selectedPelajaranId' => $selectedPelajaranId,
            'studentsWithGrades' => $studentsWithGrades,
            'historyNilai' => $historyNilai
        ]);
    }

    /**
     * Simpan / Perbarui Nilai (Single atau Batch)
     */
    public function simpanNilai() {
        verify_csrf();
        $guruId = (int)$_SESSION['user_id'];
        $nilaiModel = $this->model('Nilai');

        $selectedKelasId = (int)($_POST['id_kelas'] ?? 0);
        $pelajaranId = (int)($_POST['pelajaran_id'] ?? 0);

        // Check if batch grade submission (array of grades)
        if (isset($_POST['batch_nilai']) && is_array($_POST['batch_nilai'])) {
            $savedCount = 0;
            foreach ($_POST['batch_nilai'] as $idSiswa => $nilaiVal) {
                if ($nilaiVal !== '' && $nilaiVal !== null) {
                    $score = floatval($nilaiVal);
                    if ($score >= 0 && $score <= 100) {
                        $nilaiModel->upsert((int)$idSiswa, $pelajaranId, $guruId, $score);
                        $savedCount++;
                    }
                }
            }
            setFlash('success', "Berhasil menyimpan {$savedCount} nilai siswa.");
        } 
        // Single student grade submission
        elseif (isset($_POST['id_siswa']) && isset($_POST['nilai'])) {
            $idSiswa = (int)$_POST['id_siswa'];
            $score = floatval($_POST['nilai']);

            if ($score < 0 || $score > 100) {
                setFlash('error', 'Nilai harus berada dalam rentang 0 - 100.');
            } else {
                if ($nilaiModel->upsert($idSiswa, $pelajaranId, $guruId, $score)) {
                    setFlash('success', 'Nilai siswa berhasil disimpan.');
                } else {
                    setFlash('error', 'Gagal menyimpan nilai siswa.');
                }
            }
        } else {
            setFlash('error', 'Data input tidak valid.');
        }

        $redirectQuery = '';
        if ($selectedKelasId && $pelajaranId) {
            $redirectQuery = "?id_kelas={$selectedKelasId}&pelajaran_id={$pelajaranId}";
        }
        redirect('guru/nilai' . $redirectQuery);
    }

    /**
     * Hapus Data Nilai
     */
    public function hapusNilai($id) {
        verify_csrf();
        $id = (int)$id;
        $guruId = (int)$_SESSION['user_id'];
        $nilaiModel = $this->model('Nilai');

        $record = $nilaiModel->getById($id);
        if (!$record || (int)$record['id_guru'] !== $guruId) {
            setFlash('error', 'Anda hanya dapat menghapus nilai yang Anda inputkan sendiri.');
            redirect('guru/nilai');
            return;
        }

        if ($nilaiModel->delete($id)) {
            setFlash('success', 'Data nilai berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus data nilai.');
        }
        redirect('guru/nilai');
    }

    /**
     * Daftar Siswa per Kelas yang diajar
     */
    public function siswa() {
        $guruId = (int)$_SESSION['user_id'];
        $jadwalModel = $this->model('Jadwal');
        $siswaModel = $this->model('Siswa');
        $kelasModel = $this->model('Kelas');

        $classes = $jadwalModel->getClassesByGuru($guruId);
        if (empty($classes)) {
            $classes = $kelasModel->getAll();
        }

        $selectedKelasId = isset($_GET['id_kelas']) ? (int)$_GET['id_kelas'] : ($classes[0]['id_kelas'] ?? 0);
        $students = [];
        $selectedKelasName = '';

        if ($selectedKelasId) {
            $students = $siswaModel->getByKelasId($selectedKelasId);
            $kelas = $kelasModel->getById($selectedKelasId);
            $selectedKelasName = $kelas['nama'] ?? '';
        }

        $this->view('guru/siswa', [
            'title' => 'Daftar Siswa Kelas',
            'classes' => $classes,
            'selectedKelasId' => $selectedKelasId,
            'selectedKelasName' => $selectedKelasName,
            'students' => $students
        ]);
    }
}
