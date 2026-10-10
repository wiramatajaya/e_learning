<main class="flex-1 flex flex-col overflow-y-auto"> 
<div class="p-6 md:p-8 space-y-8">
    
    <!-- Header Halaman & Navigasi Tab -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-800/60 pb-5">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-wide">Daftar Evaluasi Ujian</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan lihat status pelaksanaan ujian mata pelajaran Anda.</p>
        </div>
        
        <!-- Toggle Tab Active/Riwayat Ujian -->
        <div class="inline-flex p-1 bg-slate-900/80 border border-slate-800 rounded-xl self-start sm:self-auto">
            <a href="index.php?url=siswa/quiz" 
               class="px-5 py-2 text-xs font-semibold text-white bg-indigo-600/90 shadow-md rounded-lg transition duration-200">
                Ujian Aktif
            </a>
            <a href="index.php?url=siswa/riwayat" 
               class="px-5 py-2 text-xs font-semibold text-slate-400 hover:text-white rounded-lg transition duration-200">
                Riwayat Ujian
            </a>
        </div>
    </div>

    <!-- Grid Kartu Ujian -->
    <?php if (empty($data['quiz'])) : ?>
        <div class="flex flex-col items-center justify-center p-12 bg-[#090d16]/60 border border-slate-800/80 rounded-2xl text-center space-y-3">
            <div class="w-12 h-12 rounded-full bg-slate-800/60 border border-slate-700/50 flex items-center justify-center text-slate-400">
                <i data-lucide="file-x" class="w-6 h-6"></i>
            </div>
            <h3 class="text-base font-semibold text-white">Tidak Ada Ujian</h3>
            <p class="text-xs text-slate-400 max-w-sm">Saat ini belum ada daftar ujian yang tersedia.</p>
        </div>
    <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            $now = time(); // Timestamp Waktu Sekarang

            foreach($data["quiz"] as $q): 
                // Set deadline ke akhir hari pengumpulan (23:59:59)
                $deadlineTime = strtotime($q['tgl_pengumpulan'] . ' 23:59:59');
                $isExpired = $now > $deadlineTime;
                
                // Cek status apakah sudah dikerjakan (opsional jika dikirim dari controller/model)
                $isDone = isset($q['is_dikerjakan']) && $q['is_dikerjakan'] == 1;

                // Format Tampilan Kategori / Jenis Ujian
                $kategori = strtoupper(trim($q['jenis_ujian']));
                $badgeKatClass = "bg-indigo-500/10 text-indigo-400 border-indigo-500/20";
                
                if (in_array($kategori, ['UTS', 'UAS'])) {
                    $badgeKatClass = "bg-amber-500/10 text-amber-400 border-amber-500/20";
                } elseif (in_array($kategori, ['L', 'TUGAS', 'LATIHAN'])) {
                    $badgeKatClass = "bg-cyan-500/10 text-cyan-400 border-cyan-500/20";
                }
            ?>

                <?php if ($isDone) : ?>
                    <!-- 1. KONDISI: SUDAH DIKERJAKAN -->
                    <div class="bg-[#090d16]/60 border border-emerald-500/30 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl relative overflow-hidden">
                        <div>
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <span class="px-3 py-1 font-bold text-xs uppercase tracking-wider rounded-lg border <?= $badgeKatClass ?>">
                                    <?= htmlspecialchars($q['jenis_ujian']) ?>
                                </span>
                                <span class="flex items-center gap-1.5 text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/30">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Sudah Dikerjakan
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-white"><?= htmlspecialchars($q['judul_ujian']) ?></h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5 flex items-center gap-1">
                                <i data-lucide="book" class="w-3.5 h-3.5 text-slate-600"></i> ID Mapel: #<?= $q['id_mapel'] ?>
                            </p>

                            <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                                    <span class="text-slate-300 font-medium"><?= date('d M Y, H:i', strtotime($q['tgl_pelaksanaan'])) ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                                    <span class="text-slate-300 font-medium"><?= $q['wktu_pengerjaan'] ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>
                                    <span class="text-slate-400 font-medium"><?= date('d M Y', strtotime($q['tgl_pengumpulan'])) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-2">
                            <a href="index.php?url=siswa/riwayat_ujian" class="w-full flex items-center justify-center gap-2 py-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-sm rounded-xl hover:bg-emerald-500/20 transition-all">
                                <i data-lucide="eye" class="w-4 h-4"></i> LIHAT HASIL NILAI
                            </a>
                        </div>
                    </div>

                <?php elseif ($isExpired) : ?>
                    <!-- 2. KONDISI: WAKTU HABIS / DITUTUP -->
                    <div class="bg-[#090d16]/40 border border-slate-800/40 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl relative overflow-hidden opacity-70 hover:opacity-100 transition-all duration-300">
                        <div>
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <span class="px-3 py-1 font-bold text-xs uppercase tracking-wider rounded-lg border <?= $badgeKatClass ?>">
                                    <?= htmlspecialchars($q['jenis_ujian']) ?>
                                </span>
                                <span class="flex items-center gap-1.5 text-xs text-slate-500 font-semibold bg-slate-800/40 px-2.5 py-1 rounded-full border border-slate-700/30">
                                    Selesai / Ditutup
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-400"><?= htmlspecialchars($q['judul_ujian']) ?></h3>
                            <p class="text-xs text-slate-600 font-medium mt-0.5 flex items-center gap-1">
                                <i data-lucide="book" class="w-3.5 h-3.5 text-slate-700"></i> ID Mapel: #<?= $q['id_mapel'] ?>
                            </p>

                            <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                                    <span class="text-slate-500 font-medium"><?= date('d M Y, H:i', strtotime($q['tgl_pelaksanaan'])) ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                                    <span class="text-slate-500 font-medium"><?= $q['wktu_pengerjaan'] ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>
                                    <span class="text-slate-500 font-medium"><?= date('d M Y', strtotime($q['tgl_pengumpulan'])) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-2">
                            <button disabled class="w-full flex items-center justify-center gap-2 py-3 bg-slate-800/40 text-slate-600 font-semibold text-sm rounded-xl border border-slate-800/60 cursor-not-allowed">
                                <i data-lucide="lock" class="w-4 h-4"></i> WAKTU HABIS
                            </button>
                        </div>
                    </div>

                <?php else : ?>
                    <!-- 3. KONDISI: MASIH AKTIF / TERSEDIA -->
                    <div class="bg-[#090d16]/80 border border-slate-800/80 rounded-2xl p-6 flex flex-col justify-between backdrop-blur-xl hover:border-indigo-500/40 hover:shadow-[0_0_30px_rgba(99,102,241,0.15)] transition-all duration-300 relative overflow-hidden group">
                        <div class="absolute -top-12 -right-12 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
                        
                        <div>
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <span class="px-3 py-1 font-bold text-xs uppercase tracking-wider rounded-lg border <?= $badgeKatClass ?>">
                                    <?= htmlspecialchars($q['jenis_ujian']) ?>
                                </span>
                                <span class="flex items-center gap-1.5 text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20 shadow-[0_0_10px_rgba(52,211,153,0.1)]">
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> Tersedia
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-white group-hover:text-indigo-300 transition-colors"><?= htmlspecialchars($q['judul_ujian']) ?></h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5 flex items-center gap-1">
                                <i data-lucide="book" class="w-3.5 h-3.5 text-slate-600"></i> ID Mapel: #<?= $q['id_mapel'] ?>
                            </p>

                            <div class="mt-6 space-y-2.5 border-t border-slate-800/40 pt-4 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Pelaksanaan:</span>
                                    <span class="text-slate-300 font-medium"><?= date('d M Y, H:i', strtotime($q['tgl_pelaksanaan'])) ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Durasi Kerja:</span>
                                    <span class="text-slate-300 font-medium"><?= $q['wktu_pengerjaan'] ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 flex items-center gap-1.5"><i data-lucide="calendar-check" class="w-4 h-4"></i> Batas Kumpul:</span>
                                    <span class="text-pink-400 font-medium shadow-[0_0_10px_rgba(236,72,153,0.1)]"><?= date('d M Y', strtotime($q['tgl_pengumpulan'])) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-2">
                            <a href="index.php?url=siswa/quiz&id=<?= $q['id_ujian'] ?>" class="w-full flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-cyan-500 text-white font-bold text-sm rounded-xl shadow-[0_4px_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.4)] transition-all duration-300">
                                <i data-lucide="play" class="w-4 h-4 fill-white"></i> MULAI KERJAKAN
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</main>