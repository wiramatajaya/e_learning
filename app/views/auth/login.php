<?php
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Login') ?> - <?= APP_NAME ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="<?= url('assets/css/custom.css') ?>">
</head>
<body class="h-full flex items-center justify-center p-4 relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">

    <!-- Ambient glowing backgrounds -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-600/25 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-violet-600/25 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-lg z-10">
        
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-600 text-white shadow-xl shadow-indigo-500/25 mb-4 transform hover:scale-105 transition-transform">
                <i data-lucide="graduation-cap" class="w-9 h-9"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">EduLearn Portal</h1>
            <p class="text-sm text-slate-400 mt-1">Sistem Informasi Akademik & E-Learning Terpadu</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white/95 backdrop-blur-xl border border-white/20 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-black/40">

            <!-- Flash Alert -->
            <?php if ($flash): ?>
                <?php 
                    $alertStyles = [
                        'success' => 'bg-emerald-50 border-emerald-300 text-emerald-800',
                        'error'   => 'bg-rose-50 border-rose-300 text-rose-800',
                        'warning' => 'bg-amber-50 border-amber-300 text-amber-800',
                        'info'    => 'bg-blue-50 border-blue-300 text-blue-800'
                    ];
                    $style = $alertStyles[$flash['type']] ?? $alertStyles['info'];
                ?>
                <div class="mb-6 p-4 rounded-2xl border flex items-center space-x-3 text-sm <?= $style ?>">
                    <i data-lucide="<?= $flash['type'] === 'success' ? 'check-circle' : ($flash['type'] === 'error' ? 'alert-circle' : 'info') ?>" class="w-5 h-5 flex-shrink-0"></i>
                    <p class="font-medium"><?= htmlspecialchars($flash['message']) ?></p>
                </div>
            <?php endif; ?>

            <!-- Role Tabs -->
            <div class="mb-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Pilih Peran Masuk (Role):</label>
                <div class="grid grid-cols-3 gap-2 p-1.5 bg-slate-100 rounded-2xl" id="roleTabs">
                    <button type="button" onclick="setRole('admin')" id="tab-admin" class="py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white text-indigo-700 shadow-sm flex items-center justify-center space-x-1.5">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>Admin</span>
                    </button>
                    <button type="button" onclick="setRole('guru')" id="tab-guru" class="py-2.5 px-3 rounded-xl text-xs font-bold transition-all text-slate-600 hover:text-slate-900 flex items-center justify-center space-x-1.5">
                        <i data-lucide="user-check" class="w-4 h-4"></i>
                        <span>Guru</span>
                    </button>
                    <button type="button" onclick="setRole('siswa')" id="tab-siswa" class="py-2.5 px-3 rounded-xl text-xs font-bold transition-all text-slate-600 hover:text-slate-900 flex items-center justify-center space-x-1.5">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        <span>Siswa</span>
                    </button>
                </div>
            </div>

            <!-- Form -->
            <form action="<?= url('auth/processLogin') ?>" method="POST" id="loginForm" class="space-y-5">
                <?= csrf_field() ?>
                <input type="hidden" name="role" id="roleInput" value="admin">

                <div>
                    <label id="identifierLabel" for="identifierInput" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Username Admin
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-5 h-5" id="identifierIcon"></i>
                        </div>
                        <input type="text" name="identifier" id="identifierInput" required
                               placeholder="Masukkan username admin..."
                               class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-medium transition-all bg-slate-50 focus:bg-white">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="passwordInput" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Kata Sandi (Password)
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" name="password" id="passwordInput" required
                               placeholder="Masukkan kata sandi..."
                               class="w-full pl-11 pr-11 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-medium transition-all bg-slate-50 focus:bg-white">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <i data-lucide="eye" id="togglePasswordIcon" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Quick Auto-Fill Demo Accounts -->
            <div class="mt-8 pt-6 border-t border-slate-200/80">
                <p class="text-xs font-semibold text-slate-500 text-center uppercase tracking-wider mb-3">
                    Akses Cepat Akun Demo (1-Klik Isi):
                </p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="button" onclick="fillDemo('admin', 'admin', 'admin123')" class="flex-1 py-2 px-3 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold border border-indigo-200/60 transition-colors text-center">
                        <span class="block text-[11px] font-bold">Admin</span>
                        <span class="text-[10px] text-indigo-500">admin123</span>
                    </button>
                    <button type="button" onclick="fillDemo('guru', '198501152010011001', 'guru123')" class="flex-1 py-2 px-3 rounded-xl bg-violet-50 hover:bg-violet-100 text-violet-700 text-xs font-semibold border border-violet-200/60 transition-colors text-center">
                        <span class="block text-[11px] font-bold">Guru (Budi)</span>
                        <span class="text-[10px] text-violet-500">guru123</span>
                    </button>
                    <button type="button" onclick="fillDemo('siswa', '20241001', 'siswa123')" class="flex-1 py-2 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold border border-emerald-200/60 transition-colors text-center">
                        <span class="block text-[11px] font-bold">Siswa (Rizky)</span>
                        <span class="text-[10px] text-emerald-500">siswa123</span>
                    </button>
                </div>
            </div>

        </div>

        <p class="text-center text-xs text-slate-500 mt-6">
            &copy; <?= date('Y') ?> EduLearn &bull; Berbasis PHP OOP MVC & Tailwind CSS
        </p>

    </div>

    <script>
        function setRole(role) {
            const roleInput = document.getElementById('roleInput');
            const label = document.getElementById('identifierLabel');
            const input = document.getElementById('identifierInput');
            const tabAdmin = document.getElementById('tab-admin');
            const tabGuru = document.getElementById('tab-guru');
            const tabSiswa = document.getElementById('tab-siswa');

            roleInput.value = role;

            // Reset tabs
            const tabs = [tabAdmin, tabGuru, tabSiswa];
            tabs.forEach(t => {
                t.className = 'py-2.5 px-3 rounded-xl text-xs font-bold transition-all text-slate-600 hover:text-slate-900 flex items-center justify-center space-x-1.5';
            });

            if (role === 'admin') {
                tabAdmin.className = 'py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white text-indigo-700 shadow-sm flex items-center justify-center space-x-1.5';
                label.innerText = 'Username Admin';
                input.placeholder = 'Masukkan username admin (contoh: admin)...';
            } else if (role === 'guru') {
                tabGuru.className = 'py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white text-indigo-700 shadow-sm flex items-center justify-center space-x-1.5';
                label.innerText = 'Nomor Induk Pegawai (NIP)';
                input.placeholder = 'Masukkan NIP guru (contoh: 19850115...)...';
            } else if (role === 'siswa') {
                tabSiswa.className = 'py-2.5 px-3 rounded-xl text-xs font-bold transition-all bg-white text-indigo-700 shadow-sm flex items-center justify-center space-x-1.5';
                label.innerText = 'Nomor Induk Siswa (NIS)';
                input.placeholder = 'Masukkan NIS siswa (contoh: 20241001)...';
            }
        }

        function fillDemo(role, identifier, password) {
            setRole(role);
            document.getElementById('identifierInput').value = identifier;
            document.getElementById('passwordInput').value = password;
        }

        function togglePasswordVisibility() {
            const pwd = document.getElementById('passwordInput');
            const icon = document.getElementById('togglePasswordIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                pwd.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        lucide.createIcons();
    </script>
</body>
</html>
