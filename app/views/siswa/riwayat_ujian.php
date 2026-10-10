<?php
?>
<div class="space-y-8 p-4">
    <!-- Header Page & Tab Toggle -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Daftar Evaluasi Ujian</h1>
            <p class="text-sm text-slate-400 mt-1">Kelola dan lihat rekapitulasi hasil ujian mata pelajaran Anda.</p>
        </div>

        <!-- Toggle Switch Active/Riwayat Ujian -->
        <div class="inline-flex p-1 bg-slate-900/80 border border-slate-800 rounded-xl self-start md:self-auto">
            <a href="/siswa/quiz" 
               class="px-5 py-2 text-xs font-semibold text-slate-400 hover:text-white rounded-lg transition duration-200">
                Ujian Aktif
            </a>
            <a href="/siswa/riwayat" 
               class="px-5 py-2 text-xs font-semibold text-white bg-indigo-600/90 shadow-md rounded-lg transition duration-200">
                Riwayat Ujian
            </a>
        </div>
    </div>

    <!-- Grid Card Riwayat Ujian -->
    <?php if (empty($riwayatUjian) || !is_array($riwayatUjian)) : ?>
        <div class="flex flex-col items-center justify-center p-12 bg-[#101626]/60 border border-slate-800/80 rounded-2xl text-center space-y-3">
            <div class="w-12 h-12 rounded-full bg-slate-800/60 border border-slate-700/50 flex items-center justify-center text-slate-400">
                <i data-lucide="history" class="w-6 h-6"></i>
            </div>
            <h3 class="text-base font-semibold text-white">Belum Ada Riwayat Ujian</h3>
            <p class="text-xs text-slate-400 max-w-sm">Anda belum menyelesaikan ujian apapun. Ujian yang telah diselesaikan akan muncul di halaman ini.</p>
        </div>
    <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($riwayatUjian as $item) : ?>
                <?php 
                    $kategoriText = isset($item['kategori']) ? $item['kategori'] : 'UH';
                    
                    // Badge Kategori
                    $badgeCategory = "bg-indigo-500/10 text-indigo-400 border-indigo-500/30";
                    if (stristr($kategoriText, 'UTS') || stristr($kategoriText, 'UAS')) {
                        $badgeCategory = "bg-amber-500/10 text-amber-400 border-amber-500/30";
                    } elseif (stristr($kategoriText, 'LATIHAN') || stristr($kategoriText, 'TUGAS')) {
                        $badgeCategory = "bg-cyan-500/10 text-cyan-400 border-cyan-500/30";
                    }

                    // Penentuan Nilai & Status KKM
                    $nilai = isset($item['nilai']) ? floatval($item['nilai']) : 0;
                    $isLulus = $nilai >= 70;

                    // Formatter Tanggal Kumpul
                    $rawTanggal = isset($item['tanggal_kumpul']) ? $item['tanggal_kumpul'] : 'now';
                    $formattedDate = date('d M Y, H:i', strtotime($rawTanggal));
                    
                    // Soal
                    $totalSoal = isset($item['total_soal']) ? $item['total_soal'] : 0;
                    $totalDijawab = isset($item['total_dijawab']) ? $item['total_dijawab'] : 0;
                ?>
                <div class="relative bg-[#101626]/80 border border-slate-800/80 hover:border-slate-700/80 rounded-2xl p-6 flex flex-col justify-between transition-all duration-200 hover:shadow-xl hover:shadow-indigo-500/5 space-y-6">
                    
                    <!-- Top Section: Kategori & Status Selesai -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border <?= $badgeCategory ?>">
                                <?= htmlspecialchars($kategoriText) ?>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Selesai
                            </span>
                        </div>

                        <!-- Judul Ujian & Mapel -->
                        <div>
                            <h3 class="text-lg font-bold text-white tracking-tight leading-snug">
                                <?= htmlspecialchars(isset($item['nama_ujian']) ? $item['nama_ujian'] : '-') ?>
                            </h3>
                            <div class="flex items-center gap-1.5 text-xs text-slate-400 mt-1">
                                <i data-lucide="book-open" class="w-3.5 h-3.5 text-slate-500"></i>
                                <span>ID Mapel: #<?= htmlspecialchars(isset($item['id_mapel']) ? $item['id_mapel'] : '-') ?> (<?= htmlspecialchars(isset($item['nama_mapel']) ? $item['nama_mapel'] : '-') ?>)</span>
                            </div>
                        </div>

                        <!-- Section Skor Akhir / Nilai -->
                        <div class="p-4 rounded-xl bg-slate-900/90 border border-slate-800/80 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400 block">Nilai Akhir</span>
                                <div class="flex items-baseline gap-1 mt-0.5">
                                    <span class="text-3xl font-extrabold tracking-tight <?= $isLulus ? 'text-emerald-400' : 'text-rose-400' ?>">
                                        <?= number_format($nilai, 1) ?>
                                    </span>
                                    <span class="text-xs text-slate-500 font-semibold">/100</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400 block">Status KKM</span>
                                <span class="inline-block mt-1 text-xs font-bold <?= $isLulus ? 'text-emerald-400' : 'text-rose-400' ?>">
                                    <?= $isLulus ? 'LULUS KKM' : 'TIDAK LULUS' ?>
                                </span>
                            </div>
                        </div>

                        <!-- Informasi Tanggal Ujian & Durasi -->
                        <div class="space-y-2 text-xs text-slate-400 pt-1">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <i data-lucide="calendar-check" class="w-3.5 h-3.5 text-slate-500"></i> Waktu Selesai:
                                </span>
                                <span class="font-medium text-slate-300"><?= $formattedDate ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <i data-lucide="check-square" class="w-3.5 h-3.5 text-slate-500"></i> Terjawab:
                                </span>
                                <span class="font-medium text-slate-300"><?= $totalDijawab ?> dari <?= $totalSoal ?> Soal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action: Detail Hasil -->
                    <div class="pt-2">
                        <a href="<?= BASEURL; ?>/siswa/hasil&id=<?= isset($item['id_ujian']) ? $item['id_ujian'] : '' ?>" 
                           class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-800 hover:border-slate-700 font-semibold rounded-xl transition text-xs flex items-center justify-center gap-2">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>Lihat Detail Hasil</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    // Memastikan Lucide Icons ter-render jika di-load
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>