<?php

$list_menu=[
    ["title"=>"Dashboard","icon"=>"home","link"=>"index.php?url=siswa/dashboard"],
    ["title"=>"Materi","icon"=>"layout-dashboard","link"=>"index.php?url=siswa/materi"],
    ["title"=>"Quiz","icon"=>"book-open","link"=>"index.php?url=siswa/quiz"],
]
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Dashboard - siswa</title>
       <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#0b0f19] font-sans text-slate-200 antialiased bg-[radial-gradient(circle_at_top_left,_var(--tw-gradient-stops))] from-[#1e1b4b]/40 via-[#0f172a] to-[#070a13]">
<main>
    <div class="min-h-screen flex items-center justify-center bg-[#0a0e17] px-4">
        <div class="w-full max-w-md p-8 bg-[#101626]/80 rounded-2xl border border-slate-800/80 shadow-[0_10px_30px_rgba(0,0,0,0.5)] backdrop-blur-md">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white tracking-wide">Selamat Datang!</h2>
                <p class="text-xs text-slate-400 mt-2">Silakan masuk ke akun E-Learning Anda</p>
            </div>

            <!-- Alert Notifikasi jika Login Gagal -->
            <?php if(isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
                <div class="mb-5 p-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-xs text-center">
                    no_induk, Password, atau Role salah!
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="index.php?url=auth/proses_login" method="POST" class="space-y-5">
                
                <!-- Pilihan Role (Pill Switch) -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-2">Masuk Sebagai:</label>
                    <div class="grid grid-cols-2 gap-3 p-1 bg-[#0a0e17] rounded-xl border border-slate-800">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="siswa" class="peer hidden" checked>
                            <div class="py-2.5 text-center text-xs font-semibold rounded-lg text-slate-400 transition-all peer-checked:bg-gradient-to-r peer-checked:from-cyan-500 peer-checked:to-indigo-600 peer-checked:text-slate-950 peer-checked:shadow-md">
                                SISWA
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="guru" class="peer hidden">
                            <div class="py-2.5 text-center text-xs font-semibold rounded-lg text-slate-400 transition-all peer-checked:bg-gradient-to-r peer-checked:from-cyan-500 peer-checked:to-indigo-600 peer-checked:text-slate-950 peer-checked:shadow-md">
                                GURU
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Input no_induk / NISN -->
                <div>
                    <label for="no_induk" class="block text-xs font-medium text-slate-400 mb-1">no_induk / NIP / NISN</label>
                    <input type="text" id="no_induk" name="no_induk" required 
                        placeholder="Masukkan ID Anda" 
                        class="w-full px-4 py-3 bg-[#141b2f] border border-slate-800 rounded-xl text-white text-xs placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition-colors">
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-xs font-medium text-slate-400 mb-1">Password</label>
                    <input type="password" id="password" name="password" required 
                        placeholder="••••••••" 
                        class="w-full px-4 py-3 bg-[#141b2f] border border-slate-800 rounded-xl text-white text-xs placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition-colors">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" 
                    class="w-full mt-2 bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-600 hover:to-indigo-700 text-slate-950 font-extrabold text-xs py-3.5 rounded-xl transition-all shadow-[0_4px_15px_rgba(6,182,212,0.25)] tracking-wider">
                    MASUK
                </button>
            </form>
        </div>
    </div>
</main>
</body>
</html>