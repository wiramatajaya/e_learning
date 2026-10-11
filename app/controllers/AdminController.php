<?php
/**
 * Admin Controller
 * Manages Master Data: Admin, Guru, Siswa, Kelas, Pelajaran, Jadwal
 */

require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller {

    public function __construct() {
        requireRole('admin');
    }

    /**
     * Dashboard Admin
     */
    public function dashboard() {
        $siswaModel = $this->model('Siswa');
        $guruModel = $this->model('Guru');
        $kelasModel = $this->model('Kelas');
        $pelajaranModel = $this->model('Pelajaran');
        $jadwalModel = $this->model('Jadwal');
        $nilaiModel = $this->model('Nilai');

        $stats = [
            'total_siswa' => $siswaModel->count(),
            'total_guru' => $guruModel->count(),
            'total_kelas' => $kelasModel->count(),
            'total_pelajaran' => $pelajaranModel->count(),
            'total_jadwal' => $jadwalModel->count(),
            'total_nilai' => $nilaiModel->count(),
        ];

        $recentJadwal = array_slice($jadwalModel->getAll(), 0, 6);
        $recentGuru = array_slice($guruModel->getAll(), 0, 5);
        $recentSiswa = array_slice($siswaModel->getAll(), 0, 5);

        $this->view('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'stats' => $stats,
            'recentJadwal' => $recentJadwal,
            'recentGuru' => $recentGuru,
            'recentSiswa' => $recentSiswa
        ]);
    }

    // ==========================================
    // MANAJEMEN GURU
    // ==========================================
    public function guru() {
        $guruModel = $this->model('Guru');
        $guruList = $guruModel->getAllWithStats();

        $this->view('admin/guru', [
            'title' => 'Manajemen Data Guru',
            'guruList' => $guruList
        ]);
    }

    public function guruStore() {
        verify_csrf();
        $nip = trim($_POST['nip'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($nip) || empty($nama) || empty($password)) {
            setFlash('error', 'Semua kolom wajib diisi.');
            redirect('admin/guru');
            return;
        }

        $guruModel = $this->model('Guru');
        if ($guruModel->getByNip($nip)) {
            setFlash('error', "NIP {$nip} sudah terdaftar.");
            redirect('admin/guru');
            return;
        }

        if ($guruModel->create($nip, $nama, $password)) {
            setFlash('success', 'Data guru berhasil ditambahkan.');
        } else {
            setFlash('error', 'Gagal menambahkan data guru.');
        }
        redirect('admin/guru');
    }

    public function guruUpdate() {
        verify_csrf();
        $id = (int)($_POST['id_guru'] ?? 0);
        $nip = trim($_POST['nip'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$id || empty($nip) || empty($nama)) {
            setFlash('error', 'Data tidak lengkap.');
            redirect('admin/guru');
            return;
        }

        $guruModel = $this->model('Guru');
        $existing = $guruModel->getByNip($nip);
        if ($existing && (int)$existing['id_guru'] !== $id) {
            setFlash('error', "NIP {$nip} sudah digunakan oleh guru lain.");
            redirect('admin/guru');
            return;
        }

        if ($guruModel->update($id, $nip, $nama, !empty($password) ? $password : null)) {
            setFlash('success', 'Data guru berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui data guru.');
        }
        redirect('admin/guru');
    }

    public function guruDelete($id) {
        verify_csrf();
        $id = (int)$id;
        $guruModel = $this->model('Guru');
        if ($guruModel->delete($id)) {
            setFlash('success', 'Data guru berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus data guru.');
        }
        redirect('admin/guru');
    }

    // ==========================================
    // MANAJEMEN SISWA
    // ==========================================
    public function siswa() {
        $siswaModel = $this->model('Siswa');
        $kelasModel = $this->model('Kelas');

        $siswaList = $siswaModel->getAll();
        $kelasList = $kelasModel->getAll();

        $this->view('admin/siswa', [
            'title' => 'Manajemen Data Siswa',
            'siswaList' => $siswaList,
            'kelasList' => $kelasList
        ]);
    }

    public function siswaStore() {
        verify_csrf();
        $nis = trim($_POST['nis'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $id_kelas = (int)($_POST['id_kelas'] ?? 0);

        if (empty($nis) || empty($nama) || empty($password) || !$id_kelas) {
            setFlash('error', 'Semua kolom wajib diisi.');
            redirect('admin/siswa');
            return;
        }

        $siswaModel = $this->model('Siswa');
        if ($siswaModel->getByNis($nis)) {
            setFlash('error', "NIS {$nis} sudah terdaftar.");
            redirect('admin/siswa');
            return;
        }

        if ($siswaModel->create($nis, $nama, $password, $id_kelas)) {
            setFlash('success', 'Data siswa berhasil ditambahkan.');
        } else {
            setFlash('error', 'Gagal menambahkan data siswa.');
        }
        redirect('admin/siswa');
    }

    public function siswaUpdate() {
        verify_csrf();
        $id = (int)($_POST['id_siswa'] ?? 0);
        $nis = trim($_POST['nis'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $id_kelas = (int)($_POST['id_kelas'] ?? 0);

        if (!$id || empty($nis) || empty($nama) || !$id_kelas) {
            setFlash('error', 'Data tidak lengkap.');
            redirect('admin/siswa');
            return;
        }

        $siswaModel = $this->model('Siswa');
        $existing = $siswaModel->getByNis($nis);
        if ($existing && (int)$existing['id_siswa'] !== $id) {
            setFlash('error', "NIS {$nis} sudah digunakan oleh siswa lain.");
            redirect('admin/siswa');
            return;
        }

        if ($siswaModel->update($id, $nis, $nama, $id_kelas, !empty($password) ? $password : null)) {
            setFlash('success', 'Data siswa berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui data siswa.');
        }
        redirect('admin/siswa');
    }

    public function siswaDelete($id) {
        verify_csrf();
        $id = (int)$id;
        $siswaModel = $this->model('Siswa');
        if ($siswaModel->delete($id)) {
            setFlash('success', 'Data siswa berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus data siswa.');
        }
        redirect('admin/siswa');
    }

    // ==========================================
    // MANAJEMEN KELAS
    // ==========================================
    public function kelas() {
        $kelasModel = $this->model('Kelas');
        $kelasList = $kelasModel->getAllWithStats();

        $this->view('admin/kelas', [
            'title' => 'Manajemen Data Kelas',
            'kelasList' => $kelasList
        ]);
    }

    public function kelasStore() {
        verify_csrf();
        $nama = trim($_POST['nama'] ?? '');
        if (empty($nama)) {
            setFlash('error', 'Nama kelas tidak boleh kosong.');
            redirect('admin/kelas');
            return;
        }

        $kelasModel = $this->model('Kelas');
        if ($kelasModel->create($nama)) {
            setFlash('success', 'Kelas baru berhasil ditambahkan.');
        } else {
            setFlash('error', 'Gagal menambahkan kelas.');
        }
        redirect('admin/kelas');
    }

    public function kelasUpdate() {
        verify_csrf();
        $id = (int)($_POST['id_kelas'] ?? 0);
        $nama = trim($_POST['nama'] ?? '');

        if (!$id || empty($nama)) {
            setFlash('error', 'Nama kelas tidak boleh kosong.');
            redirect('admin/kelas');
            return;
        }

        $kelasModel = $this->model('Kelas');
        if ($kelasModel->update($id, $nama)) {
            setFlash('success', 'Data kelas berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui data kelas.');
        }
        redirect('admin/kelas');
    }

    public function kelasDelete($id) {
        verify_csrf();
        $id = (int)$id;
        $kelasModel = $this->model('Kelas');
        if ($kelasModel->delete($id)) {
            setFlash('success', 'Kelas berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus kelas.');
        }
        redirect('admin/kelas');
    }

    // ==========================================
    // MANAJEMEN PELAJARAN
    // ==========================================
    public function pelajaran() {
        $pelajaranModel = $this->model('Pelajaran');
        $pelajaranList = $pelajaranModel->getAllWithStats();

        $this->view('admin/pelajaran', [
            'title' => 'Manajemen Mata Pelajaran',
            'pelajaranList' => $pelajaranList
        ]);
    }

    public function pelajaranStore() {
        verify_csrf();
        $nama = trim($_POST['nama_pelajaran'] ?? '');
        if (empty($nama)) {
            setFlash('error', 'Nama mata pelajaran tidak boleh kosong.');
            redirect('admin/pelajaran');
            return;
        }

        $pelajaranModel = $this->model('Pelajaran');
        if ($pelajaranModel->create($nama)) {
            setFlash('success', 'Mata pelajaran berhasil ditambahkan.');
        } else {
            setFlash('error', 'Gagal menambahkan mata pelajaran.');
        }
        redirect('admin/pelajaran');
    }

    public function pelajaranUpdate() {
        verify_csrf();
        $id = (int)($_POST['pelajaran_id'] ?? 0);
        $nama = trim($_POST['nama_pelajaran'] ?? '');

        if (!$id || empty($nama)) {
            setFlash('error', 'Nama mata pelajaran tidak boleh kosong.');
            redirect('admin/pelajaran');
            return;
        }

        $pelajaranModel = $this->model('Pelajaran');
        if ($pelajaranModel->update($id, $nama)) {
            setFlash('success', 'Mata pelajaran berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui mata pelajaran.');
        }
        redirect('admin/pelajaran');
    }

    public function pelajaranDelete($id) {
        verify_csrf();
        $id = (int)$id;
        $pelajaranModel = $this->model('Pelajaran');
        if ($pelajaranModel->delete($id)) {
            setFlash('success', 'Mata pelajaran berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus mata pelajaran.');
        }
        redirect('admin/pelajaran');
    }

    // ==========================================
    // MANAJEMEN JADWAL
    // ==========================================
    public function jadwal() {
        $jadwalModel = $this->model('Jadwal');
        $kelasModel = $this->model('Kelas');
        $pelajaranModel = $this->model('Pelajaran');
        $guruModel = $this->model('Guru');

        $jadwalList = $jadwalModel->getAll();
        $kelasList = $kelasModel->getAll();
        $pelajaranList = $pelajaranModel->getAll();
        $guruList = $guruModel->getAll();

        $this->view('admin/jadwal', [
            'title' => 'Manajemen Jadwal Pelajaran',
            'jadwalList' => $jadwalList,
            'kelasList' => $kelasList,
            'pelajaranList' => $pelajaranList,
            'guruList' => $guruList
        ]);
    }

    public function jadwalStore() {
        verify_csrf();
        $hari = trim($_POST['hari'] ?? '');
        $jam = trim($_POST['jam'] ?? '');
        $menit = trim($_POST['menit'] ?? '');
        $id_kelas = (int)($_POST['id_kelas'] ?? 0);
        $pelajaran_id = (int)($_POST['pelajaran_id'] ?? 0);
        $id_guru = (int)($_POST['id_guru'] ?? 0);

        if (empty($hari) || empty($jam) || !$id_kelas || !$pelajaran_id || !$id_guru) {
            setFlash('error', 'Semua kolom jadwal wajib diisi.');
            redirect('admin/jadwal');
            return;
        }

        $jadwalModel = $this->model('Jadwal');
        $created = $jadwalModel->create([
            'hari' => $hari,
            'jam' => $jam,
            'menit' => $menit,
            'id_kelas' => $id_kelas,
            'pelajaran_id' => $pelajaran_id,
            'id_guru' => $id_guru
        ]);

        if ($created) {
            setFlash('success', 'Jadwal pelajaran berhasil ditambahkan.');
        } else {
            setFlash('error', 'Gagal menambahkan jadwal pelajaran.');
        }
        redirect('admin/jadwal');
    }

    public function jadwalUpdate() {
        verify_csrf();
        $id = (int)($_POST['jadwal_id'] ?? 0);
        $hari = trim($_POST['hari'] ?? '');
        $jam = trim($_POST['jam'] ?? '');
        $menit = trim($_POST['menit'] ?? '');
        $id_kelas = (int)($_POST['id_kelas'] ?? 0);
        $pelajaran_id = (int)($_POST['pelajaran_id'] ?? 0);
        $id_guru = (int)($_POST['id_guru'] ?? 0);

        if (!$id || empty($hari) || empty($jam) || !$id_kelas || !$pelajaran_id || !$id_guru) {
            setFlash('error', 'Data jadwal tidak lengkap.');
            redirect('admin/jadwal');
            return;
        }

        $jadwalModel = $this->model('Jadwal');
        $updated = $jadwalModel->update($id, [
            'hari' => $hari,
            'jam' => $jam,
            'menit' => $menit,
            'id_kelas' => $id_kelas,
            'pelajaran_id' => $pelajaran_id,
            'id_guru' => $id_guru
        ]);

        if ($updated) {
            setFlash('success', 'Jadwal pelajaran berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui jadwal pelajaran.');
        }
        redirect('admin/jadwal');
    }

    public function jadwalDelete($id) {
        verify_csrf();
        $id = (int)$id;
        $jadwalModel = $this->model('Jadwal');
        if ($jadwalModel->delete($id)) {
            setFlash('success', 'Jadwal berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus jadwal.');
        }
        redirect('admin/jadwal');
    }

    // ==========================================
    // MANAJEMEN AKUN ADMIN
    // ==========================================
    public function accounts() {
        $adminModel = $this->model('Admin');
        $adminList = $adminModel->getAll();

        $this->view('admin/accounts', [
            'title' => 'Manajemen Akun Administrator',
            'adminList' => $adminList
        ]);
    }

    public function accountStore() {
        verify_csrf();
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            setFlash('error', 'Username dan password wajib diisi.');
            redirect('admin/accounts');
            return;
        }

        $adminModel = $this->model('Admin');
        if ($adminModel->getByUsername($username)) {
            setFlash('error', "Username '{$username}' sudah digunakan.");
            redirect('admin/accounts');
            return;
        }

        if ($adminModel->create($username, $password)) {
            setFlash('success', 'Akun admin baru berhasil dibuat.');
        } else {
            setFlash('error', 'Gagal membuat akun admin.');
        }
        redirect('admin/accounts');
    }

    public function accountUpdate() {
        verify_csrf();
        $id = (int)($_POST['id_admin'] ?? 0);
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$id || empty($username)) {
            setFlash('error', 'Username tidak boleh kosong.');
            redirect('admin/accounts');
            return;
        }

        $adminModel = $this->model('Admin');
        $existing = $adminModel->getByUsername($username);
        if ($existing && (int)$existing['id_admin'] !== $id) {
            setFlash('error', "Username '{$username}' sudah dipakai admin lain.");
            redirect('admin/accounts');
            return;
        }

        if ($adminModel->update($id, $username, !empty($password) ? $password : null)) {
            setFlash('success', 'Akun admin berhasil diperbarui.');
        } else {
            setFlash('error', 'Gagal memperbarui akun admin.');
        }
        redirect('admin/accounts');
    }

    public function accountDelete($id) {
        verify_csrf();
        $id = (int)$id;

        // Prevent admin from deleting their own current account
        if ($id === (int)($_SESSION['user_id'] ?? 0)) {
            setFlash('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login.');
            redirect('admin/accounts');
            return;
        }

        $adminModel = $this->model('Admin');
        if ($adminModel->delete($id)) {
            setFlash('success', 'Akun admin berhasil dihapus.');
        } else {
            setFlash('error', 'Gagal menghapus akun admin.');
        }
        redirect('admin/accounts');
    }
}
