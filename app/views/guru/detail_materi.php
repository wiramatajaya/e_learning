<?php
 ?>
    <!-- CONTAINER UTAMA -->
    <main class="p-4 md:p-8 max-w-[1500px] mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI & TENGAH (2/3): Konten Utama & Player/Berkas Materi -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail Deskripsi Materi -->
                       <?php foreach($data['meteri'] as $m): ?>
            <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-xl shadow-lg space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800/60 pb-4">
                    <div>
                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-widest bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 rounded-md">
                            Mata Pelajaran: Matematika
                        </span>
                        <h1 class="text-2xl font-extrabold text-white tracking-tight mt-2"><?= $m["judul"] ?></h1>
                    </div>
                    <div class="flex gap-2">
                        <a href=<?= "index.php?url=guru/edit_materi&id=".$m['id_materi']  ?> class="px-4 py-2 bg-cyan-600 border border-slate-800 hover:border-slate-700 text-xs font-bold rounded-xl text-slate-300 flex items-center gap-1.5 transition">
                            <i data-lucide="square-pen" class="w-4 h-4 text-white shrink-0"></i>
                            edit 
                       </a>

                        
                            <?php if (!empty($m['file_path'])) : ?>
                            <!-- Tombol Unduh Modul -->
                            <a href="public/uploads/materi/<?= htmlspecialchars($m['file_path']); ?>" 
                            download="<?= htmlspecialchars($m['judul']); ?>.pdf"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-300/50 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-lg transition duration-200">
                                <i data-lucide="download" class="w-4 h-4"></i> Unduh Modul
                            </a>
                            <?php endif; ?>
                    </div>
                </div>

                <!-- Isi Materi -->
                <div class="space-y-2 text-sm text-slate-300 leading-relaxed">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-400"><?= $m['tenggat_waktu'] ?></h3>
                    <p><?= $m['materi'] ?></p>
                    <!-- Callout Alert Box -->
                    <a class="p-4 bg-amber-500/5 border border-amber-500/20 rounded-xl flex gap-2 items-start cursor-pointer">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-amber-400 shrink-0 mt-0.5"></i>
                            <strong class="text-amber-300 block mb-0.5 text-nowrap">latihan Soal :</strong>
                            Pengumpulan dilakukan via menu tugas sebelum batas tenggat berakhir.
                       </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>


        <!-- KOLOM KANAN (1/3): Meta Data & List Materi Lain (id_mapel: 2) -->
        <div class="space-y-4">
            <a href="index.php?url=guru/tambah_materi" class=" ">
                <p class="w-full rounded-xl h-[4rem] text-center justify-center mb-4 flex items-center text-medium font-bold  bg-gradient-to-r from-cyan-500 to-indigo-600">Tambah Materi</p> </a>
            <!-- KARTU INFORMASI TENGGAT WAKTU -->
            <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-xl shadow-lg space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-purple-400 flex items-center gap-1.5">
                    <i data-lucide="clock" class="w-4 h-4"></i> Materi Saat Ini
                </h3>
                
                <div class="p-4 bg-[#101626]/60 border border-slate-800/80 rounded-xl space-y-3">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400">Tenggat Waktu:</span>
                        <span class="text-rose-400 font-bold font-mono">2026-08-15 06:31:11</span>
                    </div>
                    <!-- Progress Bar Status Selesai -->
                    <div class="space-y-1">
                        <div class="flex justify-between text-[11px]">
                            <span class="text-slate-500">Sisa Waktu Terbuka</span>
                            <span class="text-indigo-400 font-semibold">Aktif</span>
                        </div>
                        <div class="w-full bg-[#070a13] h-2 rounded-full overflow-hidden p-[1px] border border-slate-800">
                            <div class="bg-gradient-to-r from-cyan-500 to-indigo-500 h-full rounded-full w-3/4 shadow-[0_0_10px_rgba(6,182,212,0.3)]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU DAFTAR MATERI SEJENIS (id_mapel: 2 / Matematika) -->
            <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-xl shadow-lg space-y-4">
                <div class="border-b border-slate-800/60 pb-3">
                    <h3 class="font-bold text-white text-sm flex items-center gap-2">
                        <i data-lucide="layers" class="w-4 h-4 text-cyan-400"></i> Latihan Soal
                    </h3>
                </div>

                <!-- List Berdasarkan id_mapel = 2 -->
                <div class="space-y-2.5">
                    
                    <!-- Item Materi ID 2 (Active/Current View) -->
                    <a href="#" class="flex items-center justify-between p-3.5 bg-gradient-to-r from-indigo-600/20 via-cyan-500/5 to-transparent border-l-4 border-cyan-400 rounded-r-xl border border-y-slate-800/80 border-r-slate-800/80 group transition">
                        <div class="truncate pr-2">
                            <h4 class="text-xs font-bold text-cyan-400 truncate">Volume Bangun Ruang</h4>
                            <span class="text-[10px] text-slate-500 block mt-0.5">ID Materi: #5 • Video</span>
                        </div>
                        <i data-lucide="eye" class="w-4 h-4 text-cyan-400 shrink-0"></i>
                    </a>
                    <?php foreach($data['quiz'] as $q):?>
                    <!-- Item Materi ID 1 -->
                     
                    <a href="index.php?url=guru/quiz" class="flex items-center justify-between p-3.5 bg-[#101626]/40 hover:bg-[#101626]/80 rounded-xl border border-slate-800/60 group transition">
                        <div class="truncate pr-2">
                            <h4 class="text-xs font-bold text-slate-300 group-hover:text-white transition"><?= $q['judul_ujian'] ?></h4>
                            <span class="text-[10px] text-slate-500 block mt-0.5">Jenis Ujian: #<?= $q['jenis_ujian'] ?> • Berkas Video</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-slate-400 transition"></i>
                    </a>
                        <?php endforeach; ?>
                </div>
            </div>

        </div>

    </main>
