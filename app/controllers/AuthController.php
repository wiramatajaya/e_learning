<?php
 class AuthController extends Controller{
   public function login() {
        $this->view('auth/login');
    }

    public function proses_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $no_induk = $_POST['no_induk'];
            $password = $_POST['password'];
            $role     = $_POST['role']; // 'siswa' atau 'guru'

            $userModel = $this->model('User');
            $user = $userModel->login($no_induk, $role);

            // Verifikasi Password (menggunakan password_verify jika di-hash, atau komparasi biasa)
            if ($user && $user['password']== $password) {
                // Set Session
                $_SESSION['id_user']  = $user['id_user'];
                $_SESSION['nama']     = $user['nama'];
                $_SESSION['role']     = $user["role"];
                $_SESSION['kelas_id']     = $user['kelas_id'];

                // Redirect Sesuai Role
                if ($role == 'guru') {
                    header("Location: index.php?url=guru/dashboard");
                } else {
                    header("Location: index.php?url=siswa/dashboard");
                }
                exit;
            } else {
                // Login gagal
                header("Location: index.php?url=auth/login&status=gagal");
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?url=auth/login");
        exit;
    }
 }