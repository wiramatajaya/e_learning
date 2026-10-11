<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Student Welcome Banner -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl mb-8">
    <div class="relative z-10 max-w-2xl">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/25 text-blue-300 border border-blue-400/30 mb-3">
            <i data-lucide="graduation-cap" class="w-3.5 h-3.5 mr-1.5"></i> Portal Siswa Akademik
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Halo, <?= htmlspecialchars($siswa['nama']) ?>! 👋</h2>
        <p class="text-sm text-blue-200 mt-2">
            NIS: <span class="font-mono font-semibold text-white"><?= htmlspecialchars($siswa['nis']) ?></span> &bull; Kelas: <span class="inline-flex px-2 py-0.5 rounded-lg bg-blue-500/30 text-white font-bold text-xs"><?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?></span>
        </p>
    </div>
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
</div>

<!-- Academic Summary Metric Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
    
    <!-- Rata-rata Nilai -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="calculator" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-indigo-600"><?= number_format($statsNilai['rata_rata'], 1) ?></p>
            <p class="text-xs font-medium text-slate-500">Rata-rata Nilai</p>
        </div>
    </div>

    <!-- Nilai Tertinggi -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="trending-up" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-emerald-600"><?= number_format($statsNilai['nilai_tertinggi'], 1) ?></p>
            <p class="text-xs font-medium text-slate-500">Nilai Tertinggi</p>
        </div>
    </div>

    <!-- Nilai Terendah -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="bar-chart-2" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-amber-600"><?= number_format($statsNilai['nilai_terendah'], 1) ?></p>
            <p class="text-xs font-medium text-slate-500">Nilai Terendah</p>
        </div>
    </div>

    <!-- Mapel Dinilai -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="book-check" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-slate-900"><?= $statsNilai['total_mapel'] ?></p>
            <p class="text-xs font-medium text-slate-500">Mapel Dinilai</p>
        </div>
    </div>

</div>

<!-- Content Grid: Jadwal Hari Ini & Ringkasan Nilai Terbaru -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Left: Jadwal Hari Ini -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Jadwal Kelas Hari Ini</h3>
                    <p class="text-xs text-slate-500"><?= $hariIni ?>, <?= date('d F Y') ?> &bull; <?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?></p>
                </div>
            </div>
            <a href="<?= url('siswa/jadwal') ?>" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center">
                <span>Lihat Jadwal Lengkap</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-0.5"></i>
            </a>
        </div>

        <?php if (empty($jadwalHariIni)): ?>
            <div class="p-8 text-center rounded-2xl bg-slate-50 border border-slate-100 text-slate-400">
                <i data-lucide="calendar-x" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
                <p class="text-sm font-medium">Tidak ada kegiatan belajar di hari <?= $hariIni ?>.</p>
                <p class="text-xs text-slate-400 mt-1">Gunakan waktu luang untuk belajar mandiri dan mengulang materi.</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($jadwalHariIni as $j): ?>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between hover:bg-blue-50/30 hover:border-blue-200 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 text-blue-600 flex flex-col items-center justify-center font-bold text-xs shadow-sm">
                                <i data-lucide="clock" class="w-4 h-4 mb-0.5"></i>
                                <span class="text-[9px] text-slate-400">SESI</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900"><?= htmlspecialchars($j['nama_pelajaran']) ?></p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    <?= htmlspecialchars($j['jam']) ?> &bull; <span class="text-slate-700 font-medium"><?= htmlspecialchars($j['nama_guru']) ?></span>
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-white text-slate-700 border border-slate-200 shadow-sm">
                            <?= htmlspecialchars($j['menit'] ?? 'Sesuai Jam') ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Right: Nilai Akademik Terkini -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Nilai Mata Pelajaran Terkini</h3>
                    <p class="text-xs text-slate-500">Transkrip hasil belajar yang telah dinilai guru</p>
                </div>
            </div>
            <a href="<?= url('siswa/nilai') ?>" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center">
                <span>Transkrip Lengkap</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-0.5"></i>
            </a>
        </div>

        <?php if (empty($recentNilai)): ?>
            <div class="p-8 text-center rounded-2xl bg-slate-50 border border-slate-100 text-slate-400">
                <p class="text-sm">Belum ada nilai yang diinputkan oleh guru.</p>
            </div>
        <?php else: ?>
            <div class="divide-y divide-slate-100">
                <?php foreach ($recentNilai as $n): ?>
                    <?php $meta = getGradeMeta($n['nilai']); ?>
                    <div class="py-3.5 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-900"><?= htmlspecialchars($n['nama_pelajaran']) ?></p>
                            <p class="text-xs text-slate-400 mt-0.5">Pengampu: <?= htmlspecialchars($n['nama_guru']) ?></p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold <?= $meta['kkm'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
                                <?= $meta['letter'] ?>
                            </span>
                            <span class="text-base font-extrabold text-slate-900 w-12 text-right">
                                <?= number_format($n['nilai'], 1) ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
