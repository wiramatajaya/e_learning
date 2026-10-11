<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action & Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex flex-col sm:flex-row gap-3 flex-1 max-w-xl">
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="siswaSearch" onkeyup="filterSiswaTable()" 
                       placeholder="Cari siswa (nama atau NIS)..."
                       class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 focus:bg-white transition-all">
            </div>

            <!-- Class Filter Dropdown -->
            <select id="kelasFilter" onchange="filterSiswaTable()" class="px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Kelas</option>
                <?php foreach ($kelasList as $k): ?>
                    <option value="<?= htmlspecialchars($k['nama']) ?>"><?= htmlspecialchars($k['nama']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="button" onclick="openAddSiswaModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Siswa Baru</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="siswaTable">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">NIS</th>
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($siswaList)): ?>
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data siswa.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($siswaList as $idx => $s): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors" data-kelas="<?= htmlspecialchars($s['nama_kelas'] ?? '') ?>">
                                <td class="py-4 px-6 text-slate-400 font-medium"><?= $idx + 1 ?></td>
                                <td class="py-4 px-6 font-mono font-medium text-slate-600"><?= htmlspecialchars($s['nis']) ?></td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs">
                                            <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                        </div>
                                        <span class="font-bold text-slate-900"><?= htmlspecialchars($s['nama']) ?></span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                                        <?= htmlspecialchars($s['nama_kelas'] ?? 'Belum ada kelas') ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center space-x-1">
                                        <button type="button" 
                                                onclick="openEditSiswaModal(<?= $s['id_siswa'] ?>, '<?= htmlspecialchars(addslashes($s['nis'])) ?>', '<?= htmlspecialchars(addslashes($s['nama'])) ?>', <?= $s['id_kelas'] ?>)" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="triggerDelete('<?= url('admin/siswaDelete/' . $s['id_siswa']) ?>', 'Hapus Siswa', 'Apakah Anda yakin ingin menghapus data siswa <?= htmlspecialchars(addslashes($s['nama'])) ?>? Seluruh riwayat nilai siswa ini akan terhapus.')" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah Siswa -->
<div id="addSiswaModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Siswa Baru</h3>
            <button type="button" onclick="closeModal('addSiswaModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/siswaStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIS Siswa</label>
                <input type="text" name="nis" required placeholder="Contoh: 20241001"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Siswa</label>
                <input type="text" name="nama" required placeholder="Contoh: Muhammad Rizky Pratama"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Penempatan Kelas</label>
                <select name="id_kelas" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Kelas Siswa --</option>
                    <?php foreach ($kelasList as $k): ?>
                        <option value="<?= $k['id_kelas'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password Akun</label>
                <input type="password" name="password" required placeholder="Kata sandi login siswa..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addSiswaModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Siswa
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div id="editSiswaModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Data Siswa</h3>
            <button type="button" onclick="closeModal('editSiswaModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/siswaUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_siswa" id="edit_id_siswa">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIS Siswa</label>
                <input type="text" name="nis" id="edit_nis" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Siswa</label>
                <input type="text" name="nama" id="edit_siswa_nama" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Penempatan Kelas</label>
                <select name="id_kelas" id="edit_id_kelas" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <?php foreach ($kelasList as $k): ?>
                        <option value="<?= $k['id_kelas'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Password Baru <span class="text-slate-400 text-[11px] font-normal">(Kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editSiswaModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddSiswaModal() {
        openModal('addSiswaModal');
    }

    function openEditSiswaModal(id, nis, nama, idKelas) {
        document.getElementById('edit_id_siswa').value = id;
        document.getElementById('edit_nis').value = nis;
        document.getElementById('edit_siswa_nama').value = nama;
        document.getElementById('edit_id_kelas').value = idKelas;
        openModal('editSiswaModal');
    }

    function filterSiswaTable() {
        const query = document.getElementById('siswaSearch').value.toLowerCase();
        const kelasVal = document.getElementById('kelasFilter').value;
        const rows = document.querySelectorAll('#siswaTable tbody tr');

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowKelas = row.getAttribute('data-kelas') || '';
            const matchSearch = text.includes(query);
            const matchKelas = !kelasVal || rowKelas === kelasVal;

            if (matchSearch && matchKelas) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
