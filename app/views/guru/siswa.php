<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <form method="GET" action="<?= url('guru/siswa') ?>" class="flex items-center space-x-3">
            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Pilih Kelas:</label>
            <select name="id_kelas" onchange="this.form.submit()" class="px-3.5 py-2 rounded-xl border border-slate-200 text-sm font-semibold bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id_kelas'] ?>" <?= ($selectedKelasId == $c['id_kelas']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nama_kelas'] ?? $c['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <div class="relative w-64">
            <input type="text" id="siswaSearch" onkeyup="filterTable('siswaSearch', 'siswaTable')" 
                   placeholder="Cari siswa..."
                   class="w-full pl-8 pr-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 focus:bg-white">
            <i data-lucide="search" class="w-3.5 h-3.5 absolute left-2.5 top-3 text-slate-400"></i>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900">Daftar Siswa <?= htmlspecialchars($selectedKelasName) ?></h3>
                <p class="text-xs text-slate-500">Total <?= count($students) ?> siswa terdaftar</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="siswaTable">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">NIS</th>
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Kelas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Belum ada siswa pada kelas ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $idx => $s): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 text-slate-400 font-medium"><?= $idx + 1 ?></td>
                                <td class="py-4 px-6 font-mono font-medium text-slate-600"><?= htmlspecialchars($s['nis']) ?></td>
                                <td class="py-4 px-6 font-bold text-slate-900">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                            <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                        </div>
                                        <span><?= htmlspecialchars($s['nama']) ?></span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        <?= htmlspecialchars($s['nama_kelas']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
