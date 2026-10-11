<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-8">

    <!-- Top Filter Section: Select Class & Subject -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
        <div class="flex items-center space-x-3 mb-5 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900">Pilih Kelas & Mata Pelajaran</h2>
                <p class="text-xs text-slate-500">Tentukan rombel kelas dan mata pelajaran untuk melakukan pengisian nilai</p>
            </div>
        </div>

        <form method="GET" action="<?= url('guru/nilai') ?>" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kelas</label>
                <select name="id_kelas" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($classes as $c): ?>
                        <option value="<?= $c['id_kelas'] ?>" <?= ($selectedKelasId == $c['id_kelas']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nama_kelas'] ?? $c['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                <select name="pelajaran_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Pelajaran --</option>
                    <?php foreach ($subjects as $s): ?>
                        <option value="<?= $s['pelajaran_id'] ?>" <?= ($selectedPelajaranId == $s['pelajaran_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['nama_pelajaran']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center space-x-2">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Tampilkan Lembar Nilai</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Active Grade Sheet Table -->
    <?php if ($selectedKelasId && $selectedPelajaranId): ?>
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Lembar Input Nilai Siswa</h3>
                    <p class="text-xs text-slate-500">Rentang nilai: 0 - 100 &bull; Standar KKM: 75.0</p>
                </div>

                <div class="flex items-center space-x-2">
                    <span class="text-xs text-slate-500 mr-2">Total Siswa: <strong class="text-slate-900"><?= count($studentsWithGrades) ?></strong></span>
                    <button type="button" onclick="document.getElementById('batchNilaiForm').submit()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/20 transition-all flex items-center space-x-1.5">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Semua Nilai Sekaligus</span>
                    </button>
                </div>
            </div>

            <?php if (empty($studentsWithGrades)): ?>
                <div class="p-12 text-center text-slate-400">
                    <i data-lucide="users-x" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                    <p class="text-sm font-semibold">Tidak ditemukan siswa pada kelas ini.</p>
                </div>
            <?php else: ?>
                <form id="batchNilaiForm" action="<?= url('guru/simpanNilai') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_kelas" value="<?= $selectedKelasId ?>">
                    <input type="hidden" name="pelajaran_id" value="<?= $selectedPelajaranId ?>">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="py-4 px-6">No</th>
                                    <th class="py-4 px-6">NIS</th>
                                    <th class="py-4 px-6">Nama Siswa</th>
                                    <th class="py-4 px-6 w-48">Nilai Angka (0-100)</th>
                                    <th class="py-4 px-6">Predikat / KKM</th>
                                    <th class="py-4 px-6 text-right">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($studentsWithGrades as $idx => $row): ?>
                                    <?php 
                                        $currentVal = $row['nilai'] !== null ? floatval($row['nilai']) : '';
                                        $meta = $currentVal !== '' ? getGradeMeta($currentVal) : null;
                                    ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="py-4 px-6 text-slate-400 font-medium"><?= $idx + 1 ?></td>
                                        <td class="py-4 px-6 font-mono font-medium text-slate-600"><?= htmlspecialchars($row['nis']) ?></td>
                                        <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                        <td class="py-4 px-6">
                                            <input type="number" step="0.01" min="0" max="100" 
                                                   name="batch_nilai[<?= $row['id_siswa'] ?>]" 
                                                   id="input_score_<?= $row['id_siswa'] ?>"
                                                   value="<?= $currentVal ?>" 
                                                   oninput="updateGradeBadge(<?= $row['id_siswa'] ?>, this.value)"
                                                   placeholder="Belum dinilai"
                                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 focus:bg-white transition-all">
                                        </td>
                                        <td class="py-4 px-6" id="badge_container_<?= $row['id_siswa'] ?>">
                                            <?php if ($meta): ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold <?= $meta['kkm'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
                                                    Predikat <?= $meta['letter'] ?> (<?= $meta['predicate'] ?>)
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-medium bg-slate-100 text-slate-400">
                                                    Belum Ada Nilai
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button type="button" 
                                                    onclick="saveSingleScore(<?= $row['id_siswa'] ?>, <?= $selectedKelasId ?>, <?= $selectedPelajaranId ?>)" 
                                                    class="px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:text-white text-xs font-semibold transition-all">
                                                Simpan Baris
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-md shadow-emerald-600/20 transition-all flex items-center space-x-2">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>Simpan Perubahan Nilai</span>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- History of All Grades Inputted by This Teacher -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Riwayat Nilai yang Telah Diinput</h3>
                <p class="text-xs text-slate-500">Daftar seluruh nilai akademik yang tercatat di bawah akun Anda</p>
            </div>
            <div class="relative w-64">
                <input type="text" id="historySearch" onkeyup="filterTable('historySearch', 'historyTable')" 
                       placeholder="Cari nama atau kelas..."
                       class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <i data-lucide="search" class="w-3.5 h-3.5 absolute left-2.5 top-2.5 text-slate-400"></i>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="historyTable">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Siswa</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6">Mata Pelajaran</th>
                        <th class="py-4 px-6">Nilai</th>
                        <th class="py-4 px-6">Predikat</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($historyNilai)): ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 text-xs">Belum ada riwayat nilai.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($historyNilai as $hn): ?>
                            <?php $meta = getGradeMeta($hn['nilai']); ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <p class="font-bold text-slate-900"><?= htmlspecialchars($hn['nama_siswa']) ?></p>
                                    <p class="text-[11px] text-slate-400 font-mono">NIS: <?= htmlspecialchars($hn['nis_siswa']) ?></p>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700">
                                        <?= htmlspecialchars($hn['nama_kelas']) ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-800"><?= htmlspecialchars($hn['nama_pelajaran']) ?></td>
                                <td class="py-4 px-6 font-bold text-base <?= $meta['kkm'] ? 'text-emerald-600' : 'text-rose-600' ?>">
                                    <?= number_format($hn['nilai'], 1) ?>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-xl text-xs font-bold <?= $meta['kkm'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' ?>">
                                        <?= $meta['letter'] ?> &bull; <?= $meta['predicate'] ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <button type="button" 
                                            onclick="triggerDelete('<?= url('guru/hapusNilai/' . $hn['nilai_id']) ?>', 'Hapus Data Nilai', 'Apakah Anda yakin ingin menghapus data nilai <?= htmlspecialchars(addslashes($hn['nama_siswa'])) ?> untuk mata pelajaran <?= htmlspecialchars(addslashes($hn['nama_pelajaran'])) ?>?')" 
                                            class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Nilai">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Hidden Single Score Submit Form -->
<form id="singleScoreForm" action="<?= url('guru/simpanNilai') ?>" method="POST" style="display: none;">
    <?= csrf_field() ?>
    <input type="hidden" name="id_kelas" id="single_id_kelas">
    <input type="hidden" name="pelajaran_id" id="single_pelajaran_id">
    <input type="hidden" name="id_siswa" id="single_id_siswa">
    <input type="hidden" name="nilai" id="single_nilai">
</form>

<script>
    function updateGradeBadge(idSiswa, val) {
        const container = document.getElementById('badge_container_' + idSiswa);
        const score = parseFloat(val);
        if (isNaN(score) || val === '') {
            container.innerHTML = '<span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-medium bg-slate-100 text-slate-400">Belum Ada Nilai</span>';
            return;
        }

        let letter = 'D', predicate = 'Kurang', isKkm = false;
        if (score >= 85) { letter = 'A'; predicate = 'Sangat Baik'; isKkm = true; }
        else if (score >= 75) { letter = 'B'; predicate = 'Baik'; isKkm = true; }
        else if (score >= 65) { letter = 'C'; predicate = 'Cukup'; isKkm = true; }

        const badgeClass = isKkm 
            ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' 
            : 'bg-rose-50 text-rose-700 border border-rose-200';

        container.innerHTML = `<span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold ${badgeClass}">Predikat ${letter} (${predicate})</span>`;
    }

    function saveSingleScore(idSiswa, idKelas, pelId) {
        const input = document.getElementById('input_score_' + idSiswa);
        if (!input.value) {
            alert('Silakan masukkan nilai terlebih dahulu.');
            return;
        }
        document.getElementById('single_id_kelas').value = idKelas;
        document.getElementById('single_pelajaran_id').value = pelId;
        document.getElementById('single_id_siswa').value = idSiswa;
        document.getElementById('single_nilai').value = input.value;
        document.getElementById('singleScoreForm').submit();
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
