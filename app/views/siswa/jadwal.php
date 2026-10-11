<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Info Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-slate-900">Jadwal Pelajaran Kelas <?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?></h2>
            <p class="text-xs text-slate-500">Jadwal kegiatan belajar mengajar mingguan untuk kelas Anda</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                <i data-lucide="clock" class="w-4 h-4 mr-1.5"></i>
                Total <?= $totalJadwal ?> Pertemuan / Minggu
            </span>
        </div>
    </div>

    <!-- Day-by-Day Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($groupedJadwal as $hari => $items): ?>
            <?php 
                $isToday = ($hari === $hariIni);
                $cardBorder = $isToday ? 'border-2 border-indigo-500 shadow-indigo-500/10' : 'border border-slate-200/80';
            ?>
            <div class="bg-white rounded-3xl <?= $cardBorder ?> p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <!-- Day Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-base font-extrabold text-slate-900"><?= $hari ?></span>
                            <?php if ($isToday): ?>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-600 text-white animate-pulse">
                                    HARI INI
                                </span>
                            <?php endif; ?>
                        </div>
                        <span class="text-xs font-semibold text-slate-400">
                            <?= count($items) ?> Mapel
                        </span>
                    </div>

                    <!-- Items -->
                    <?php if (empty($items)): ?>
                        <div class="py-8 text-center text-slate-400 text-xs">
                            Tidak ada mata pelajaran di hari <?= $hari ?>.
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach ($items as $item): ?>
                                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-indigo-50/40 hover:border-indigo-200 transition-all">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-indigo-700 flex items-center">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 mr-1 text-indigo-400"></i>
                                            <?= htmlspecialchars($item['jam']) ?>
                                        </span>
                                        <?php if (!empty($item['menit'])): ?>
                                            <span class="text-[10px] font-medium text-slate-400"><?= htmlspecialchars($item['menit']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm font-bold text-slate-900"><?= htmlspecialchars($item['nama_pelajaran']) ?></p>
                                    <p class="text-xs text-slate-500 mt-1 flex items-center">
                                        <i data-lucide="user" class="w-3 h-3 mr-1 text-slate-400"></i>
                                        <?= htmlspecialchars($item['nama_guru']) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 text-right">
                    <span class="text-[11px] text-slate-400">Semester Ganjil / Genap</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
