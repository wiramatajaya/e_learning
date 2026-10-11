<?php
/**
 * Configuration & Core Helpers
 * Sistem Informasi E-Learning MVC
 */

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Credentials
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'e_learn_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', 3306);

// Application Meta
define('APP_NAME', 'EduLearn');
define('APP_DESC', 'Sistem Informasi E-Learning & Akademik Sekolah');
define('APP_VERSION', '1.0.0');

// Dynamic BASE_URL Detection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$reqUri = $_SERVER['REQUEST_URI'] ?? '';

if (strpos($reqUri, '/e_learn/public') !== false) {
    define('BASE_URL', $protocol . $host . '/e_learn/public');
} elseif (strpos($reqUri, '/e_learn') !== false) {
    define('BASE_URL', $protocol . $host . '/e_learn');
} else {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    define('BASE_URL', rtrim($protocol . $host . ($scriptDir === '/' ? '' : $scriptDir), '/'));
}

// CSRF Token Helper
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_token() {
    return $_SESSION['csrf_token'] ?? '';
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token()) . '">';
}

function verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            setFlash('error', 'Token keamanan (CSRF) tidak valid. Silakan coba lagi.');
            redirect('auth/login');
            exit;
        }
    }
}

// Flash Message Helpers
function setFlash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type, // 'success', 'error', 'warning', 'info'
        'message' => $message
    ];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

// Auth Helpers
function isLoggedIn() {
    return !empty($_SESSION['user']) && !empty($_SESSION['role']);
}

function getRole() {
    return $_SESSION['role'] ?? null;
}

function getUser() {
    return $_SESSION['user'] ?? null;
}

function requireAuth() {
    if (!isLoggedIn()) {
        setFlash('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        redirect('auth/login');
        exit;
    }
}

function requireRole($allowedRoles) {
    requireAuth();
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }
    if (!in_array(getRole(), $allowedRoles)) {
        setFlash('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
        switch (getRole()) {
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'guru':
                redirect('guru/dashboard');
                break;
            case 'siswa':
                redirect('siswa/dashboard');
                break;
            default:
                redirect('auth/login');
        }
        exit;
    }
}

// Redirect Helper
function redirect($path) {
    $path = ltrim($path, '/');
    header('Location: ' . BASE_URL . '/' . $path);
    exit;
}

// Safe URL Generation
function url($path = '') {
    $path = ltrim($path, '/');
    return BASE_URL . ($path ? '/' . $path : '');
}

// Helper to determine active menu
function isActiveNav($keyword, $uri = null) {
    $uri = $uri ?? ($_SERVER['REQUEST_URI'] ?? '');
    return strpos($uri, $keyword) !== false ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/30' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80';
}

// Helper to determine Grade Letter & Status
function getGradeMeta($score) {
    $score = floatval($score);
    if ($score >= 85) {
        return ['letter' => 'A', 'predicate' => 'Sangat Baik', 'color' => 'emerald', 'kkm' => true];
    } elseif ($score >= 75) {
        return ['letter' => 'B', 'predicate' => 'Baik', 'color' => 'blue', 'kkm' => true];
    } elseif ($score >= 65) {
        return ['letter' => 'C', 'predicate' => 'Cukup', 'color' => 'amber', 'kkm' => true];
    } else {
        return ['letter' => 'D', 'predicate' => 'Kurang (Perlu Remedial)', 'color' => 'rose', 'kkm' => false];
    }
}


