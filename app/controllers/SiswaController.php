<?php
/**
 * Siswa Controller
 * Handles Student Portal: Dashboard, Jadwal Pelajaran Kelas, & Transkrip Nilai
 */

require_once __DIR__ . '/../core/Controller.php';

class SiswaController extends Controller {

    public function __construct() {
        requireRole('siswa');
    }

    private function getIndonesianDay(): string {
        $dayNum = date('N');
        $map = [
            1 => 'Senin',2 => 'Selasa',3 => 'Rabu',4 => 'Kamis',5 => 'Jumat',6 => 'Sabtu',7 => 'Minggu'
        ];
        return $map[$dayNum] ?? 'Senin';
    }

    /**
     * Dashboard Siswa
     */
    public function dashboard() {
        $siswaId = (int)$_SESSION['user_id'];
        $siswaModel = $this->model('Siswa');
        $jadwalModel = $this->model('Jadwal');
        $nilaiModel = $this->model('Nilai');

        $siswa = $siswaModel->getById($siswaId);
        $idKelas = (int)$siswa['id_kelas'];
        $hariIni = $this->getIndonesianDay();

        $jadwalHariIni = $jadwalModel->getTodayByKelas($idKelas, $hariIni);
        $statsNilai = $nilaiModel->getStatsBySiswa($siswaId);
        $recentNilai = array_slice($nilaiModel->getBySiswaId($siswaId), 0, 5);
        $totalJadwalSeminggu = count($jadwalModel->getByKelasId($idKelas));

        $this->view('siswa/dashboard', [
            'title' => 'Dashboard Siswa',
            'siswa' => $siswa,
            'hariIni' => $hariIni,
            'jadwalHariIni' => $jadwalHariIni,
            'statsNilai' => $statsNilai,
            'recentNilai' => $recentNilai,
            'totalJadwalSeminggu' => $totalJadwalSeminggu
        ]);
    }

    /**
     * Jadwal Pelajaran Kelas Siswa
     */
    public function jadwal() {
        $siswaId = (int)$_SESSION['user_id'];
        $siswaModel = $this->model('Siswa');
        $jadwalModel = $this->model('Jadwal');

        $siswa = $siswaModel->getById($siswaId);
        $idKelas = (int)$siswa['id_kelas'];
        $hariIni = $this->getIndonesianDay();

        $jadwalList = $jadwalModel->getByKelasId($idKelas);

        // Group by day
        $grouped = [];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        foreach ($days as $d) {
            $grouped[$d] = [];
        }
        foreach ($jadwalList as $j) {
            $grouped[$j['hari']][] = $j;
        }

        $this->view('siswa/jadwal', [
            'title' => 'Jadwal Pelajaran Kelas',
            'siswa' => $siswa,
            'groupedJadwal' => $grouped,
            'hariIni' => $hariIni,
            'totalJadwal' => count($jadwalList)
        ]);
    }

    /**
     * Transkrip Nilai Akademik Siswa
     */
    public function nilai() {
        $siswaId = (int)$_SESSION['user_id'];
        $siswaModel = $this->model('Siswa');
        $nilaiModel = $this->model('Nilai');

        $siswa = $siswaModel->getById($siswaId);
        $nilaiList = $nilaiModel->getBySiswaId($siswaId);
        $statsNilai = $nilaiModel->getStatsBySiswa($siswaId);

        // Enrich with meta (Letter, Predicate, KKM status)
        foreach ($nilaiList as &$item) {
            $item['meta'] = getGradeMeta($item['nilai']);
        }
        unset($item);

        $this->view('siswa/nilai', [
            'title' => 'Transkrip Nilai Akademik',
            'siswa' => $siswa,
            'nilaiList' => $nilaiList,
            'statsNilai' => $statsNilai
        ]);
    }
}
