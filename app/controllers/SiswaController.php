<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class SiswaController extends Controller{
    function dashboard(){

        $this->view('siswa/dashboard');
    }

    function soal(){
        $this->view('siswa/soal');
    }

        

    public function quiz(){
        $ujian = $this->model("Ujian");
        $data["quiz"]=$ujian->getAllUjian();
        $this->view('siswa/quiz',$data);
    }

public function quizId() {
    $id_ujian = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $role=$_SESSION['role'];
    if ($page < 1) $page = 1;
    // Ambil ID User dari Session (Sesuaikan variabel session login Anda)
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 1;
    $ujianModel = $this->model("Ujian");

    // --- A. JIKA ADA POST REQUEST (Simpan Jawaban atau Submit Kuis) ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Jika siswa memilih opsi jawaban
        if (isset($_POST['id_soal']) && isset($_POST['jawaban'])) {
            $id_soal = intval($_POST['id_soal']);
            $jawaban = $_POST['jawaban'];
            $ujianModel->simpanJawaban($id_user, $id_soal, $jawaban);
        }

        // Jika siswa menekan tombol "Selesai Ujian"
        if (isset($_POST['submit_quiz'])) {
            $hasil=$ujianModel->submitDanHitungNilai($id_user, $id_ujian);
            $pesan = "Anda menjawab " . $hasil['jawaban_benar'] . " benar dari " . $hasil['total_soal'] . " soal.";
                    header("Location: index.php?url=".$role."/riwayat_ujian");
            exit;
        }

        // Pindah ke halaman target jika ditentukan (tombol Next/Prev)
        $nextPage = isset($_POST['next_page']) ? intval($_POST['next_page']) : $page;
        header("Location: index.php?url=".$role."/quiz&id=" . $id_ujian . "&page=" . $nextPage);
        exit;
    }

    // --- B. MANAJEMEN DATA UNTUK VIEW ---
    $allSoal = $ujianModel->getSoalByUjian($id_ujian);
    $totalSoal = count($allSoal);

    if ($page > $totalSoal && $totalSoal > 0) {
        $page = $totalSoal;
    }

    $currentSoal = isset($allSoal[$page - 1]) ? $allSoal[$page - 1] : null;

    // Ambil jawaban yang pernah dipilih untuk soal ini
    $jawabanTerpilih = null;
    if ($currentSoal) {
        $jawabanData = $ujianModel->getJawabanSiswa($id_user, $currentSoal['id_soal']);
        if ($jawabanData) {
            $jawabanTerpilih = $jawabanData['jawaban'];
        }
    }

    // Ambil daftar semua ID soal yang sudah dijawab untuk penanda di grid navigasi
    $semuaJawaban = $ujianModel->getAllJawabanSiswaByUjian($id_user, $id_ujian);
    $soalDijawabList = array_column($semuaJawaban, 'id_soal');

    $data["id_ujian"]         = $id_ujian;
    $data["soal"]             = $currentSoal;
    $data["total_soal"]       = $totalSoal;
    $data["current_page"]     = $page;
    $data["jawaban_terpilih"] = $jawabanTerpilih;
    $data["all_soal"]         = $allSoal;
    $data["soal_dijawab"]     = $soalDijawabList;

    $this->view('siswa/quiz_id', $data);
}


public function riwayat_ujian() {
    $id_user = $_SESSION['id_user'];

    // Ambil data riwayat pengerjaan dari model
    $data['riwayatUjian'] = $this->model('Ujian')->getRiwayatUjianBySiswa($id_user);
    
    $this->view('siswa/riwayat_ujian', $data);
}



    public function submit() {
        $ujian=$this->model('Ujian');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['user_id'] ?? 3; 
            $id_ujian = $_POST['id_ujian'];
            $jawaban = $_POST['jawaban'] ?? [];

            $skor = $ujian->submitUjian($id_user, $id_ujian, $jawaban);

            $data['skor'] = $skor;
            $this->view('siswa/hasil', $data);
        }
    }


    public function materi(){
            $materi = $this->model("Materi");
            $pelajaran = $this->model("Pelajaran");
            $data["pelajaran"]=$pelajaran->getAllPelajaran();
            $this->view('siswa/materi',$data);
        }



}