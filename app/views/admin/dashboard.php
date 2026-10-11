<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Top Welcome Banner -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-indigo-900 p-6 sm:p-8 text-white shadow-xl mb-8">
    <div class="relative z-10 max-w-2xl">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-3">
            <i data-lucide="shield-check" class="w-3.5 h-3.5 mr-1.5"></i> Panel Administrator
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Selamat Datang, <?= htmlspecialchars($displayName) ?>! 👋</h2>
        <p class="text-sm text-indigo-200 mt-2 leading-relaxed">
            Kelola data akademik sekolah, informasi guru, siswa, kelas, mata pelajaran, serta penyusunan jadwal secara terintegrasi dan real-time.
        </p>
    </div>
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
</div>

<!-- Statistic Metric Cards -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    
    <!-- Siswa -->
    <a href="<?= url('admin/siswa') ?>" class="group p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-semibold text-slate-400 group-hover:text-blue-600">&rarr;</span>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_siswa'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Total Siswa</p>
    </a>

    <!-- Guru -->
    <a href="<?= url('admin/guru') ?>" class="group p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="user-check" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-semibold text-slate-400 group-hover:text-indigo-600">&rarr;</span>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_guru'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Total Guru</p>
    </a>

    <!-- Kelas -->
    <a href="<?= url('admin/kelas') ?>" class="group p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="door-open" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-semibold text-slate-400 group-hover:text-emerald-600">&rarr;</span>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_kelas'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Total Kelas</p>
    </a>

    <!-- Pelajaran -->
    <a href="<?= url('admin/pelajaran') ?>" class="group p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="book-open" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-semibold text-slate-400 group-hover:text-amber-600">&rarr;</span>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_pelajaran'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Mata Pelajaran</p>
    </a>

    <!-- Jadwal -->
    <a href="<?= url('admin/jadwal') ?>" class="group p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="calendar-clock" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-semibold text-slate-400 group-hover:text-purple-600">&rarr;</span>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_jadwal'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Sesi Jadwal</p>
    </a>

    <!-- Nilai -->
    <div class="p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <i data-lucide="award" class="w-5 h-5"></i>
            </div>
        </div>
        <p class="text-2xl font-bold text-slate-900"><?= $stats['total_nilai'] ?></p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">Data Nilai</p>
    </div>

</div>

<!-- Content Grid: Quick Schedule Preview & Master Lists -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left 2 Cols: Jadwal Pelajaran Terbaru -->
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Jadwal Pelajaran Sekolah</h3>
                <p class="text-xs text-slate-500">Pratinjau jadwal kegiatan belajar mengajar</p>
            </div>
            <a href="<?= url('admin/jadwal') ?>" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 flex items-center space-x-1">
                <span>Kelola Jadwal</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 text-xs uppercase font-semibold">
                        <th class="pb-3">Hari & Jam</th>
                        <th class="pb-3">Kelas</th>
                        <th class="pb-3">Mata Pelajaran</th>
                        <th class="pb-3">Guru Pengampu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($recentJadwal)): ?>
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-400 text-xs">Belum ada data jadwal pelajaran.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($recentJadwal as $j): ?>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 mr-2">
                                        <?= htmlspecialchars($j['hari']) ?>
                                    </span>
                                    <span class="text-xs text-slate-500"><?= htmlspecialchars($j['jam']) ?></span>
                                </td>
                                <td class="py-3 font-semibold text-slate-800"><?= htmlspecialchars($j['nama_kelas']) ?></td>
                                <td class="py-3 text-indigo-600 font-medium"><?= htmlspecialchars($j['nama_pelajaran']) ?></td>
                                <td class="py-3 text-slate-600 text-xs"><?= htmlspecialchars($j['nama_guru']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right 1 Col: Shortcut List Siswa & Guru -->
    <div class="space-y-6">
        
        <!-- Quick Teacher List -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Guru Terdaftar</h3>
                <a href="<?= url('admin/guru') ?>" class="text-xs text-indigo-600 font-semibold hover:underline">Semua</a>
            </div>
            <div class="space-y-3">
                <?php foreach ($recentGuru as $g): ?>
                    <div class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                <?= strtoupper(substr($g['nama'], 0, 1)) ?>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800"><?= htmlspecialchars($g['nama']) ?></p>
                                <p class="text-[10px] text-slate-400">NIP: <?= htmlspecialchars($g['nip']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Quick Students List -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Siswa Terdaftar</h3>
                <a href="<?= url('admin/siswa') ?>" class="text-xs text-indigo-600 font-semibold hover:underline">Semua</a>
            </div>
            <div class="space-y-3">
                <?php foreach ($recentSiswa as $s): ?>
                    <div class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                                <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800"><?= htmlspecialchars($s['nama']) ?></p>
                                <p class="text-[10px] text-slate-400">NIS: <?= htmlspecialchars($s['nis']) ?> &bull; <?= htmlspecialchars($s['nama_kelas'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
