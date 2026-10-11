<?php
$role = getRole();
$user = getUser();
$displayName = $_SESSION['display_name'] ?? 'User';
$flash = getFlash();

$currentUri = $_SERVER['REQUEST_URI'] ?? '';
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? APP_NAME) ?> - <?= APP_NAME ?></title>

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url('assets/css/custom.css') ?>">
</head>
<body class="h-full text-slate-800 antialiased font-sans">
<div class="min-h-full flex">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden hidden transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="main-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200/80 flex flex-col transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:static lg:inset-auto">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-6 border-b border-slate-100 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white">
            <a href="<?= url() ?>" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform">
                    <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-white via-slate-100 to-indigo-200 bg-clip-text text-transparent">EduLearn</span>
                    <span class="block text-xs text-indigo-300 font-medium">Sistem Informasi Sekolah</span>
                </div>
            </a>
        </div>

        <!-- Role Badge & User Profile Widget -->
        <div class="p-4 mx-4 my-3 rounded-2xl bg-gradient-to-br from-slate-50 to-indigo-50/50 border border-indigo-100/60">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-indigo-600/20">
                    <?= strtoupper(substr($displayName, 0, 1)) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate"><?= htmlspecialchars($displayName) ?></p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider
                        <?= $role === 'admin' ? 'bg-amber-100 text-amber-800 border border-amber-200' : ($role === 'guru' ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200') ?>">
                        <?= htmlspecialchars($role) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Nav Items -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto py-2">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>

            <?php if ($role === 'admin'): ?>
                <a href="<?= url('admin/dashboard') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/dashboard', $currentUri) ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= url('admin/guru') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/guru', $currentUri) ?>">
                    <i data-lucide="user-check" class="w-5 h-5 mr-3"></i>
                    <span>Data Guru</span>
                </a>
                <a href="<?= url('admin/siswa') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/siswa', $currentUri) ?>">
                    <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                    <span>Data Siswa</span>
                </a>
                <a href="<?= url('admin/kelas') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/kelas', $currentUri) ?>">
                    <i data-lucide="door-open" class="w-5 h-5 mr-3"></i>
                    <span>Data Kelas</span>
                </a>
                <a href="<?= url('admin/pelajaran') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/pelajaran', $currentUri) ?>">
                    <i data-lucide="book-open" class="w-5 h-5 mr-3"></i>
                    <span>Mata Pelajaran</span>
                </a>
                <a href="<?= url('admin/jadwal') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/jadwal', $currentUri) ?>">
                    <i data-lucide="calendar-clock" class="w-5 h-5 mr-3"></i>
                    <span>Jadwal Pelajaran</span>
                </a>
                <a href="<?= url('admin/accounts') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('admin/accounts', $currentUri) ?>">
                    <i data-lucide="shield-check" class="w-5 h-5 mr-3"></i>
                    <span>Akun Admin</span>
                </a>

            <?php elseif ($role === 'guru'): ?>
                <a href="<?= url('guru/dashboard') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('guru/dashboard', $currentUri) ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    <span>Dashboard Guru</span>
                </a>
                <a href="<?= url('guru/jadwal') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('guru/jadwal', $currentUri) ?>">
                    <i data-lucide="calendar" class="w-5 h-5 mr-3"></i>
                    <span>Jadwal Mengajar</span>
                </a>
                <a href="<?= url('guru/nilai') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('guru/nilai', $currentUri) ?>">
                    <i data-lucide="award" class="w-5 h-5 mr-3"></i>
                    <span>Input & Kelola Nilai</span>
                </a>
                <a href="<?= url('guru/siswa') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('guru/siswa', $currentUri) ?>">
                    <i data-lucide="users-round" class="w-5 h-5 mr-3"></i>
                    <span>Daftar Siswa Kelas</span>
                </a>

            <?php elseif ($role === 'siswa'): ?>
                <a href="<?= url('siswa/dashboard') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('siswa/dashboard', $currentUri) ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    <span>Dashboard Siswa</span>
                </a>
                <a href="<?= url('siswa/jadwal') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('siswa/jadwal', $currentUri) ?>">
                    <i data-lucide="calendar" class="w-5 h-5 mr-3"></i>
                    <span>Jadwal Pelajaran</span>
                </a>
                <a href="<?= url('siswa/nilai') ?>" class="flex items-center px-3.5 py-2.5 rounded-xl text-sm transition-all <?= isActiveNav('siswa/nilai', $currentUri) ?>">
                    <i data-lucide="file-badge-2" class="w-5 h-5 mr-3"></i>
                    <span>Transkrip Nilai</span>
                </a>
            <?php endif; ?>
        </nav>

        <!-- Bottom Logout Option -->
        <div class="p-4 border-t border-slate-200/80">
            <a href="<?= url('auth/logout') ?>" class="flex items-center w-full px-3.5 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                <span>Keluar (Logout)</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-slate-200/80 flex items-center justify-between px-4 sm:px-8">
            <div class="flex items-center space-x-3">
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight"><?= htmlspecialchars($title ?? 'Dashboard') ?></h1>
                    <p class="text-xs text-slate-500 hidden sm:block">Sistem Manajemen Akademik & E-Learning</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-slate-400 font-medium"><?= date('l, d F Y') ?></p>
                    <p class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($displayName) ?></p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold border border-slate-200">
                    <?= strtoupper(substr($displayName, 0, 1)) ?>
                </div>
            </div>
        </header>

        <!-- Page Body -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-8 bg-slate-50/70">

            <!-- Flash Alert Messages -->
            <?php if ($flash): ?>
                <?php 
                    $alertStyles = [
                        'success' => 'bg-emerald-50 border-emerald-300 text-emerald-800 icon-check-circle',
                        'error'   => 'bg-rose-50 border-rose-300 text-rose-800 icon-alert-circle',
                        'warning' => 'bg-amber-50 border-amber-300 text-amber-800 icon-alert-triangle',
                        'info'    => 'bg-blue-50 border-blue-300 text-blue-800 icon-info'
                    ];
                    $style = $alertStyles[$flash['type']] ?? $alertStyles['info'];
                ?>
                <div class="mb-6 p-4 rounded-2xl border flex items-center justify-between shadow-sm <?= $style ?> animate-fade-in" role="alert">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="<?= $flash['type'] === 'success' ? 'check-circle' : ($flash['type'] === 'error' ? 'alert-circle' : 'info') ?>" class="w-5 h-5 flex-shrink-0"></i>
                        <p class="text-sm font-semibold"><?= htmlspecialchars($flash['message']) ?></p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="p-1 hover:opacity-75 rounded-lg">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            <?php endif; ?>
