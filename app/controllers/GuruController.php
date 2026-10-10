<?php
class  GuruController extends Controller{
    function dashboard(){
        $pelajaran = $this->model("Pelajaran");
        $materi = $this->model("Materi");
        $jadwalHarian=$pelajaran->getJadwalPelajaranByHari(2);   
        $jadwal=$pelajaran->getJadwalPelajaran();   
        $jadwalDikelompokkan = []; 
        
        foreach ($jadwal as $row) {
            $hari = $row['id_hari'];
            $jadwalDikelompokkan[$hari][] = [
                'id_jadwal'=> $row['id_jadwal'],'jam_mulai'=> substr($row['jam_mulai'], 0, 5), 'jam_selesai'=> substr($row['jam_selesai'], 0, 5),'mata_pelajaran' => $row['mata_pelajaran']];
        }
        $data["head_cards"]=["total_ujian"=>$materi->getUjianSelesai(),"total_materi"=>$materi->getMateriSelesai()];
        $data["jadwal"]= $jadwalDikelompokkan;
        $data["jadwal_harian"]=   $jadwalHarian;    

            $this->view('guru/dashboard',$data);
    }


    public function quiz(){
        $materi = $this->model("Materi");
        $pelajaran = $this->model("Pelajaran");
        $data["pelajaran"]=$pelajaran->getAllPelajaran();
        $this->view('guru/quiz');
    }

    public function quizId() {
        $id_ujian = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page < 1) $page = 1;

        // Ambil ID User dari Session (Sesuaikan variabel session login Anda)
        $id_user = isset($_SESSION['user']['id_user']) ? $_SESSION['user']['id_user'] : 1;

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
                $ujianModel->submitDanHitungNilai($id_user, $id_ujian);
                header("Location: index.php?url=guru/hasil&id=" . $id_ujian);
                exit;
            }

            // Pindah ke halaman target jika ditentukan (tombol Next/Prev)
            $nextPage = isset($_POST['next_page']) ? intval($_POST['next_page']) : $page;
            header("Location: index.php?url=guru/quiz&id=" . $id_ujian . "&page=" . $nextPage);
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

        $this->view('guru/quiz_id', $data);
    }



    public function Materi(){
        $materi = $this->model("Materi");
        $pelajaran = $this->model("Pelajaran");
        $data["pelajaran"]=$pelajaran->getAllPelajaran();
        $this->view('guru/materi',$data);
    }
    
    public function materiId(){
        $materi = $this->model("Materi");
        $quiz= $this->model("Ujian");

        $data["meteri"]=$materi->getMateriByMapelId(intval($_GET["id"]),intval($_SESSION["kelas_id"]));
        $data["quiz"]=$quiz->getUjianByMapelId(intval($_GET["id"]));

        $this->view('guru/detail_materi',$data);
    }




    public function edit_pelajaranId(){
        $this->view('guru/edit_pelajaran');
    }

    public function riwayat_ujian() {
        $id_user = $_SESSION['id_user'];

        // Ambil data riwayat pengerjaan dari model
        $data['riwayatUjian'] = $this->model('Ujian')->getRiwayatUjianBySiswa($id_user);
        
        $this->view('siswa/riwayat_ujian', $data);
    }


    public function tambah_mapel() {
        $pelajaran = $this->model("Pelajaran");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($pelajaran->insertPelajaran($_POST)) {
                header("Location: index.php?url=guru/dashboard");
            } else {
                header("Location: index.php?url=guru/dashboard");
            }
            exit;
        }
        $data["pelajaran"]=$pelajaran->getAllPelajaran();
        $this->view('guru/pelajaran',$data);
    }

    public function edit_mapel() {
        $pelajaran = $this->model("Pelajaran");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Update ke database
            $pelajaran->updatePelajaran($_POST);
        }
        $data["pelajaran"]=$pelajaran->getAllPelajaran();
        $this->view('guru/pelajaran',$data);
    }

    // Menampilkan Halaman Form Tambah Materi
    public function tambah_materi() {
        $data['judul'] = 'Tambah Materi Pembelajaran';
        $data['mapel'] = $this->model('Pelajaran')->getAllPelajaran();
        
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Handling Upload File Lampiran (PDF / Video)
            $filePath = NULL;
            if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
                $fileTmp   = $_FILES['file_path']['tmp_name'];
                $fileName  = time() . '_' . $_FILES['file_path']['name'];
                $uploadDir = './public/uploads/materi/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                move_uploaded_file($fileTmp, $uploadDir . $fileName);
                $filePath = $fileName;
            }

            // 2. Handling Upload Gambar / Thumbnail
            $gambarPath = 0; // Default jika tidak ada gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $imgTmp    = $_FILES['gambar']['tmp_name'];
                $imgName   = time() . '_' . $_FILES['gambar']['name'];
                $imgDir    = './public/uploads/materi/';

                if (!is_dir($imgDir)) {
                    mkdir($imgDir, 0777, true);
                }
                move_uploaded_file($imgTmp, $imgDir . $imgName);
                $gambarPath = $imgName;
            }

            // Set ID Guru dari Session (Sesuaikan variabel session Anda)
            $_POST['id_guru'] = $_SESSION['id_guru'] ?? 1; 

            // Simpan ke database
            if ($this->model('Materi')->insertMateri($_POST, $filePath, $gambarPath) > 0) {
                header('Location: ' . "index.php?url=" . 'guru/pelajaran');
                exit;
            } else {
                header('Location: ' . "index.php?url=" . 'guru/tambah_materi');
                exit;
            }
        }
        $this->view('guru/tambah_materi', $data);
    }

    // Proses Simpan Data Form ke Database
    public function simpan_materi() {

    }

// Halaman Form Edit Materi (Menampilkan data lama)
    public function edit_materiId(){
        $materi = $this->model("Materi");
        $pelajaran = $this->model("Pelajaran");
        $id_materi = intval($_GET["id"]);
        $data["materi"] = $materi->getMateriById($id_materi);
        $data["pelajaran"] = $pelajaran->getAllPelajaran();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $materiModel = $this->model("Materi");
            $id_materi = intval($_POST['id_materi']);
            $materiLama = $materiModel->getMateriById($id_materi);

            $filePath = NULL;
            if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
                $fileTmp   = $_FILES['file_path']['tmp_name'];
                $fileName  = time() . '_' . $_FILES['file_path']['name'];
                $uploadDir = './public/uploads/materi/';
                if (!is_dir($uploadDir)) {mkdir($uploadDir, 0777, true);}
                move_uploaded_file($fileTmp, $uploadDir . $fileName);
                $filePath = $fileName;
            }

            // Handle Upload Gambar
            $gambar = $materiLama['gambar'];
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "./public/uploads/materi/";
                $gambar = $targetDir . time() . '_' . basename($_FILES['gambar']['name']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
            }

            $data = [
                'id_materi' => $id_materi, 'judul' => $_POST['judul'], 'materi' => $_POST['materi'],
                'id_mapel'  => intval($_POST['id_mapel']), 'tenggat_waktu' => $_POST['tenggat_waktu'], 'file_path' => $filePath,
                'gambar'    => $gambar
            ];

            if ($materiModel->updateMateri($data)) {
                header('Location: index.php?url=guru/materi');
                exit;
            } else {
                var_dump($materiModel->updateMateri($data));
            }
            exit;
        }
        $this->view('guru/edit_materi',$data);
    }



public function tambah_quiz(){
    $pelajaran = $this->model("Pelajaran");
    $data["pelajaran"] = $pelajaran->getAllPelajaran();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ujianModel = $this->model("Ujian");

        // 1. Data Ujian (Header)
        $dataUjian = [
            'judul_ujian'     => $_POST['judul_ujian'],
            'jenis_ujian'     => $_POST['jenis_ujian'],
            'id_mapel'        => intval($_POST['id_mapel']),
            'tgl_pelaksanaan' => $_POST['tgl_pelaksanaan'],
            'tgl_pengumpulan' => $_POST['tgl_pengumpulan'],
            'wktu_pengerjaan' => $_POST['wktu_pengerjaan']
        ];

        // Simpan header ujian & ambil ID ujian baru
        $id_ujian = $ujianModel->tambahUjian($dataUjian);

        if ($id_ujian) {
            $tipeSoal = $_POST['tipe_soal'] ?? 'pg';

            // Folder untuk menyimpan upload gambar
                $uploadDir = './public/uploads/materi/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // 2A. Jika Tipe Soal PILIHAN GANDA
            if ($tipeSoal === 'pg' && isset($_POST['soal'])) {
                foreach ($_POST['soal'] as $index => $s) {
                    $namaGambar = null;

                    // Cek apakah ada file gambar yang diupload untuk soal nomor ini
                    if (isset($_FILES["gambar_soal_$index"]) && $_FILES["gambar_soal_$index"]['error'] === UPLOAD_ERR_OK) {
                        $tmpName   = $_FILES["gambar_soal_$index"]['tmp_name'];
                        $ext       = pathinfo($_FILES["gambar_soal_$index"]['name'], PATHINFO_EXTENSION);
                        $namaGambar = time() . '_' . $index . '.' . $ext;
                        move_uploaded_file($tmpName, $uploadDir . $namaGambar);
                    }

                    $dataSoal = [
                        'id_ujian'      => $id_ujian,
                        'pertanyaan'    => $s['pertanyaan'],
                        'gambar'        => $namaGambar, // Masukkan nama file gambar
                        'opsi_a'        => $s['opsi_a'],
                        'opsi_b'        => $s['opsi_b'],
                        'opsi_c'        => $s['opsi_c'],
                        'opsi_d'        => $s['opsi_d'],
                        'jawaban_benar' => $s['jawaban_benar']
                    ];
                    $ujianModel->tambahSoal($dataSoal);
                }
            } 
            // 2B. Jika Tipe Soal ESAI
            elseif ($tipeSoal === 'esai' && isset($_POST['petunjuk_esai'])) {
                $namaGambar = null;

                if (isset($_FILES['gambar_esai']) && $_FILES['gambar_esai']['error'] === UPLOAD_ERR_OK) {
                    $tmpName   = $_FILES['gambar_esai']['tmp_name'];
                    $ext       = pathinfo($_FILES['gambar_esai']['name'], PATHINFO_EXTENSION);
                    $namaGambar = time() . '_esai.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $namaGambar);
                }

                $dataEsai = [
                    'id_ujian'      => $id_ujian,
                    'pertanyaan'    => $_POST['petunjuk_esai'],
                    'img'        => $namaGambar,
                    'opsi_a'        => '-',
                    'opsi_b'        => '-',
                    'opsi_c'        => '-',
                    'opsi_d'        => '-',
                    'jawaban_benar' => '-'
                ];
                $ujianModel->tambahSoal($dataEsai);
            }
        }

        header('Location: index.php?url=guru/quiz');
        exit;
    }

    $this->view('guru/tambah_quiz', $data);
}


}