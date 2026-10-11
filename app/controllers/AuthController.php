<?php
/**
 * Auth Controller
 * Handles Multi-role Authentication (Admin, Guru, Siswa)
 */

require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller {

    public function index() {
        $this->login();
    }

    public function login() {
        // If already logged in, redirect to respective dashboard
        if (isLoggedIn()) {
            $role = getRole();
            redirect($role . '/dashboard');
            return;
        }

        $this->view('auth/login', [
            'title' => 'Login - Sistem E-Learning'
        ]);
    }

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('auth/login');
            return;
        }

        verify_csrf();

        $role = trim($_POST['role'] ?? '');
        $identifier = trim($_POST['identifier'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($role) || empty($identifier) || empty($password)) {
            setFlash('error', 'Semua kolom formulir login wajib diisi.');
            redirect('auth/login');
            return;
        }

        $user = null;
        $displayName = '';
        $id = null;

        if ($role === 'admin') {
            $adminModel = $this->model('Admin');
            $user = $adminModel->getByUsername($identifier);
            if ($user && password_verify($password, $user['password'])) {
                $displayName = $user['username'];
                $id = $user['id_admin'];
            }
        } elseif ($role === 'guru') {
            $guruModel = $this->model('Guru');
            $user = $guruModel->getByNip($identifier);
            if ($user && password_verify($password, $user['password'])) {
                $displayName = $user['nama'];
                $id = $user['id_guru'];
            }
        } elseif ($role === 'siswa') {
            $siswaModel = $this->model('Siswa');
            $user = $siswaModel->getByNis($identifier);
            if ($user && password_verify($password, $user['password'])) {
                $displayName = $user['nama'];
                $id = $user['id_siswa'];
            }
        } else {
            setFlash('error', 'Peran pengguna tidak valid.');
            redirect('auth/login');
            return;
        }

        if ($user && $id) {
            // Login successful
            session_regenerate_id(true);
            
            // Remove password before saving in session
            unset($user['password']);

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['display_name'] = $displayName;

            setFlash('success', "Selamat datang, {$displayName}!");

            switch ($role) {
                case 'admin':
                    redirect('admin/dashboard');
                    break;
                case 'guru':
                    redirect('guru/dashboard');
                    break;
                case 'siswa':
                    redirect('siswa/dashboard');
                    break;
            }
        } else {
            setFlash('error', 'Kredensial tidak valid. Silakan periksa kembali username/NIP/NIS dan password Anda.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        // Start a fresh session just to store the flash message
        session_start();
        setFlash('info', 'Anda telah berhasil keluar dari sistem.');
        redirect('auth/login');
    }
}
