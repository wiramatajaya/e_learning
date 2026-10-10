 <main class="flex-1 flex flex-col overflow-y-auto"> 
<div class="p-6 md:p-8 space-y-8">
    <!-- Header Halaman & Navigasi Tab Mini -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-800/60 pb-5">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-wide">Daftar Evaluasi Ujian</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan lihat status pelaksanaan ujian mata pelajaran Anda.</p>
        </div>
        
        <!-- Tab Filter (Opsional, Meniru gaya Daftar Materi / Daftar Tugas Anda) -->
        <div class="flex items-center gap-2 bg-[#090d16]/60 p-1.5 rounded-xl border border-slate-800/40 backdrop-blur-md">
            <button class="px-4 py-2 bg-gradient-to-r from-indigo-600/30 to-cyan-500/10 text-cyan-400 font-semibold text-sm rounded-lg border-l-2 border-cyan-400 shadow-[0_0_15px_rgba(6,182,212,0.1)] transition-all">
                Ujian Aktif
            </button>
            <a href="index.php?url=guru/tambah_quiz" class="px-4 py-2 text-slate-400 hover:text-white font-medium text-sm rounded-lg transition-all">
                Tambah Quiz
            </a>
        </div>
    </div>

    <!-- Grid Kartu Ujian (Responsive 1, 2, atau 3 Kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- KARTU 1: UJIAN AKTIF (CONTOH: UH 1 Matematika) -->
        <div class="bg-[#090d16]/80 border border-slate-800/80 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl hover:border-indigo-500/40 hover:shadow-[0_0_30px_rgba(99,102,241,0.15)] transition-all duration-300 relative overflow-hidden group">
            <!-- Dekorasi Neon Glow Efek Pojok -->
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
            
            <div>
                <!-- Baris Atas: Label Jenis Ujian & Badge Status -->
                <div class="flex items-center justify-between gap-3 mb-4">
                    <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 font-bold text-xs uppercase tracking-wider rounded-lg border border-indigo-500/20">
                        Ulangan Harian
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20 shadow-[0_0_10px_rgba(52,211,153,0.1)]">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> Tersedia
                    </span>
                </div>

                <!-- Judul Ujian & Mapel -->
                <h3 class="text-lg font-bold text-white group-hover:text-indigo-300 transition-colors">UH 1 Matematika</h3>
                <p class="text-xs text-slate-500 font-medium mt-0.5 flex items-center gap-1">
                    <i data-lucide="book" class="w-3.5 h-3.5 text-slate-600"></i> ID Mapel: #1
                </p>

                <!-- Informasi Detail Ujian -->
                <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                        <span class="text-slate-300 font-medium">01 Mar 2026, 08:00</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                        <span class="text-slate-300 font-medium">01 Jam 00 Menit</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>
                        <span class="text-pink-400 font-medium shadow-[0_0_10px_rgba(236,72,153,0.1)]">01 Agt 2026</span>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="mt-6 pt-2">
                <a href="index.php?url=guru/quiz&id=1" class="w-full flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-cyan-500 text-white font-bold text-sm rounded-xl shadow-[0_4px_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.4)] transition-all duration-300">
                    <i data-lucide="play" class="w-4 h-4 fill-white"></i> MULAI KERJAKAN
                </a>
            </div>
        </div>

        <!-- KARTU 2: UJIAN EXPIRED/SUDAH LEWAT (CONTOH: UTS Matematika) -->
        <div class="bg-[#090d16]/40 border border-slate-800/40 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl relative overflow-hidden opacity-75 hover:opacity-100 transition-all duration-300">
            <div>
                <div class="flex items-center justify-between gap-3 mb-4">
                    <span class="px-3 py-1 bg-amber-500/10 text-amber-400 font-bold text-xs uppercase tracking-wider rounded-lg border border-amber-500/20">
                        UTS
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-slate-500 font-semibold bg-slate-800/40 px-2.5 py-1 rounded-full border border-slate-700/30">
                        Selesai / Ditutup
                    </span>
                </div>

                <h3 class="text-lg font-bold text-slate-400">UTS Matematika</h3>
                <p class="text-xs text-slate-600 font-medium mt-0.5 flex items-center gap-1">
                    <i data-lucide="book" class="w-3.5 h-3.5 text-slate-700"></i> ID Mapel: #2
                </p>

                <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                        <span class="text-slate-500 font-medium">15 Nov 2023, 09:00</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                        <span class="text-slate-500 font-medium">01 Jam 00 Menit</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>
                        <span class="text-slate-500 font-medium">01 Okt 2026</span>
                    </div>
                </div>
            </div>

            <!-- Tombol Nonaktif karena Masa Ujian Habis -->
            <div class="mt-6 pt-2">
                <button disabled class="w-full flex items-center justify-center gap-2 py-3 bg-slate-800/40 text-slate-600 font-semibold text-sm rounded-xl border border-slate-800/60 cursor-not-allowed">
                    <i data-lucide="lock" class="w-4 h-4"></i> WAKTU HABIS
                </button>
            </div>
        </div>

        <!-- KARTU 3: TUGAS/LATIHAN AKTIF (CONTOH: tugas harian) -->
        <div class="bg-[#090d16]/80 border border-slate-800/80 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl hover:border-cyan-500/40 hover:shadow-[0_0_30px_rgba(6,182,212,0.15)] transition-all duration-300 relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-all"></div>
            
            <div>
                <div class="flex items-center justify-between gap-3 mb-4">
                    <span class="px-3 py-1 bg-cyan-500/10 text-cyan-400 font-bold text-xs uppercase tracking-wider rounded-lg border border-cyan-500/20">
                        Latihan / Tugas
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20 shadow-[0_0_10px_rgba(52,211,153,0.1)]">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> Tersedia
                    </span>
                </div>

                <h3 class="text-lg font-bold text-white group-hover:text-cyan-300 transition-colors">Tugas Harian Matematika</h3>
                <p class="text-xs text-slate-500 font-medium mt-0.5 flex items-center gap-1">
                    <i data-lucide="book" class="w-3.5 h-3.5 text-slate-600"></i> ID Mapel: #1
                </p>

                <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                        <span class="text-slate-300 font-medium">20 Jul 2026, 17:30</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                        <span class="text-slate-300 font-medium">01 Jam 30 Menit</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>