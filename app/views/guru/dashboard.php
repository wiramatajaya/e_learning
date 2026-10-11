<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Teacher Welcome Banner -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl mb-8">
    <div class="relative z-10 max-w-2xl">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/25 text-indigo-300 border border-indigo-400/30 mb-3">
            <i data-lucide="award" class="w-3.5 h-3.5 mr-1.5"></i> Portal Pendidik & Pengajar
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Selamat Bertugas, <?= htmlspecialchars($guru['nama'] ?? $displayName) ?>! 👨‍🏫</h2>
        <p class="text-sm text-indigo-200 mt-2">
            NIP: <span class="font-mono font-semibold text-white"><?= htmlspecialchars($guru['nip'] ?? '-') ?></span> &bull; Hari ini: <span class="font-bold text-amber-300"><?= $hariIni ?></span>
        </p>
    </div>
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
</div>

<!-- Teacher Metric Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="door-open" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-slate-900"><?= $totalKelas ?></p>
            <p class="text-xs font-medium text-slate-500">Kelas Diajar</p>
        </div>
    </div>

    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="book-open" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-slate-900"><?= $totalMapel ?></p>
            <p class="text-xs font-medium text-slate-500">Mapel Diampu</p>
        </div>
    </div>

    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="calendar" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-slate-900"><?= $totalJadwal ?></p>
            <p class="text-xs font-medium text-slate-500">Total Sesi Mengajar</p>
        </div>
    </div>

    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm flex items-center space-x-4">
        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
            <i data-lucide="award" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-slate-900"><?= $totalNilai ?></p>
            <p class="text-xs font-medium text-slate-500">Nilai Siswa Diinput</p>
        </div>
    </div>
</div>

<!-- Two Columns Grid: Today's Schedule & Recent Grades -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Left: Jadwal Hari Ini -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Jadwal Mengajar Hari Ini</h3>
                    <p class="text-xs text-slate-500"><?= $hariIni ?>, <?= date('d F Y') ?></p>
                </div>
            </div>
            <a href="<?= url('guru/jadwal') ?>" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center">
                <span>Jadwal Lengkap</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-0.5"></i>
            </a>
        </div>

        <?php if (empty($jadwalHariIni)): ?>
            <div class="p-8 text-center rounded-2xl bg-slate-50 border border-slate-100 text-slate-400">
                <i data-lucide="coffee" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
                <p class="text-sm font-medium">Tidak ada jadwal mengajar untuk hari <?= $hariIni ?>.</p>
                <p class="text-xs text-slate-400 mt-1">Gunakan waktu ini untuk mengoreksi atau menginput nilai siswa.</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($jadwalHariIni as $j): ?>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between hover:border-indigo-200 hover:bg-indigo-50/30 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 text-indigo-600 flex flex-col items-center justify-center font-bold text-xs shadow-sm">
                                <i data-lucide="clock" class="w-4 h-4 mb-0.5"></i>
                                <span class="text-[10px] text-slate-500">WAKTU</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900"><?= htmlspecialchars($j['nama_pelajaran']) ?></p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Kelas <span class="font-bold text-indigo-600"><?= htmlspecialchars($j['nama_kelas']) ?></span> &bull; <?= htmlspecialchars($j['jam']) ?>
                                </p>
                            </div>
                        </div>
                        <a href="<?= url('guru/nilai?id_kelas=' . $j['id_kelas'] . '&pelajaran_id=' . $j['pelajaran_id']) ?>" class="px-3 py-1.5 rounded-xl bg-white border border-indigo-200 text-indigo-600 text-xs font-semibold hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                            Input Nilai
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Right: Riwayat Penginputan Nilai Terakhir -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Nilai Terakhir Diinput</h3>
                    <p class="text-xs text-slate-500">Riwayat penilaian tugas & ujian siswa</p>
                </div>
            </div>
            <a href="<?= url('guru/nilai') ?>" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center">
                <span>Kelola Nilai</span>
                <i data-lucide="chevron-right" class="w-4 h-4 ml-0.5"></i>
            </a>
        </div>

        <?php if (empty($recentNilai)): ?>
            <div class="p-8 text-center rounded-2xl bg-slate-50 border border-slate-100 text-slate-400">
                <p class="text-sm">Anda belum menginput nilai siswa.</p>
                <a href="<?= url('guru/nilai') ?>" class="inline-block mt-3 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-semibold">
                    Mulai Input Nilai Sekarang
                </a>
            </div>
        <?php else: ?>
            <div class="divide-y divide-slate-100">
                <?php foreach ($recentNilai as $n): ?>
                    <div class="py-3 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs">
                                <?= strtoupper(substr($n['nama_siswa'], 0, 1)) ?>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900"><?= htmlspecialchars($n['nama_siswa']) ?></p>
                                <p class="text-[11px] text-slate-400"><?= htmlspecialchars($n['nama_kelas']) ?> &bull; <?= htmlspecialchars($n['nama_pelajaran']) ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-extrabold <?= floatval($n['nilai']) >= 75 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
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
