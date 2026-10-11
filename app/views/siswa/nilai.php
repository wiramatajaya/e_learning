<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action & Print Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm print:hidden">
        <div>
            <h2 class="text-base font-bold text-slate-900">Transkrip Nilai Akademik Siswa</h2>
            <p class="text-xs text-slate-500">Hasil pencapaian kompetensi dan evaluasi belajar</p>
        </div>
        <button type="button" onclick="window.print()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-md transition-all">
            <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
            <span>Cetak Transkrip Nilai</span>
        </button>
    </div>

    <!-- Student Info Card (Printable) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        
        <!-- School & Student Info Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-200/80 mb-6 gap-4">
            <div>
                <span class="text-xs uppercase font-extrabold tracking-wider text-indigo-600">RAPOR ELEKTRONIK SISWA</span>
                <h3 class="text-2xl font-extrabold text-slate-900 mt-1"><?= htmlspecialchars($siswa['nama']) ?></h3>
                <p class="text-sm text-slate-500 mt-0.5">
                    NIS: <span class="font-mono font-semibold text-slate-700"><?= htmlspecialchars($siswa['nis']) ?></span> &bull; 
                    Kelas: <span class="font-bold text-slate-800"><?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?></span>
                </p>
            </div>

            <!-- Grade GPA Badge -->
            <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-indigo-600/20">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-indigo-900"><?= number_format($statsNilai['rata_rata'], 1) ?></p>
                    <p class="text-xs font-semibold text-indigo-600">Rata-Rata Keseluruhan</p>
                </div>
            </div>
        </div>

        <!-- Metric Highlights -->
        <div class="grid grid-cols-3 gap-4 mb-8 print:hidden">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium">Mata Pelajaran Dinilai</p>
                <p class="text-xl font-extrabold text-slate-800 mt-1"><?= $statsNilai['total_mapel'] ?></p>
            </div>
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-center">
                <p class="text-xs text-emerald-600 font-medium">Nilai Tertinggi</p>
                <p class="text-xl font-extrabold text-emerald-700 mt-1"><?= number_format($statsNilai['nilai_tertinggi'], 1) ?></p>
            </div>
            <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 text-center">
                <p class="text-xs text-blue-600 font-medium">Nilai Terendah</p>
                <p class="text-xl font-extrabold text-blue-700 mt-1"><?= number_format($statsNilai['nilai_terendah'], 1) ?></p>
            </div>
        </div>

        <!-- Grade Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-50 border-y border-slate-200 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Mata Pelajaran</th>
                        <th class="py-3.5 px-4">Guru Pengampu</th>
                        <th class="py-3.5 px-4 text-center w-24">KKM</th>
                        <th class="py-3.5 px-4 text-center w-28">Nilai Angka</th>
                        <th class="py-3.5 px-4 text-center w-24">Predikat</th>
                        <th class="py-3.5 px-4 text-center w-36">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($nilaiList)): ?>
                        <tr>
                            <td colspan="7" class="py-10 text-center text-slate-400">Belum ada data nilai mata pelajaran yang diinput.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($nilaiList as $idx => $item): ?>
                            <?php $meta = $item['meta']; ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-4 text-center text-slate-400 font-medium"><?= $idx + 1 ?></td>
                                <td class="py-4 px-4 font-bold text-slate-900"><?= htmlspecialchars($item['nama_pelajaran']) ?></td>
                                <td class="py-4 px-4 text-xs text-slate-600"><?= htmlspecialchars($item['nama_guru']) ?></td>
                                <td class="py-4 px-4 text-center font-mono text-xs text-slate-500">75.0</td>
                                <td class="py-4 px-4 text-center font-bold text-base <?= $meta['kkm'] ? 'text-slate-900' : 'text-rose-600' ?>">
                                    <?= number_format($item['nilai'], 1) ?>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold <?= $meta['kkm'] ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
                                        <?= $meta['letter'] ?>
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <?php if ($meta['kkm']): ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i data-lucide="check" class="w-3 h-3 mr-1"></i> Tuntas
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <i data-lucide="alert-circle" class="w-3 h-3 mr-1"></i> Remedial
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Grade Criteria Guide -->
        <div class="mt-8 pt-6 border-t border-slate-200/80 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-emerald-700">A (85 - 100)</span>
                <p class="text-slate-500 mt-0.5">Sangat Baik</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-blue-700">B (75 - 84)</span>
                <p class="text-slate-500 mt-0.5">Baik (Memenuhi KKM)</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-amber-700">C (65 - 74)</span>
                <p class="text-slate-500 mt-0.5">Cukup</p>
            </div>
            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <span class="font-bold text-rose-700">D (0 - 64)</span>
                <p class="text-slate-500 mt-0.5">Perlu Pendampingan</p>
            </div>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
