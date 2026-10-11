<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input type="text" id="guruSearch" onkeyup="filterTable('guruSearch', 'guruTable')" 
                   placeholder="Cari guru berdasarkan nama atau NIP..."
                   class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 focus:bg-white transition-all">
        </div>

        <button type="button" onclick="openAddGuruModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Guru Baru</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="guruTable">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">NIP</th>
                        <th class="py-4 px-6">Nama Guru</th>
                        <th class="py-4 px-6">Statistik Mengajar</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($guruList)): ?>
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data guru.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($guruList as $idx => $g): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-4 px-6 text-slate-400 font-medium"><?= $idx + 1 ?></td>
                                <td class="py-4 px-6 font-mono font-medium text-slate-600"><?= htmlspecialchars($g['nip']) ?></td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                            <?= strtoupper(substr($g['nama'], 0, 1)) ?>
                                        </div>
                                        <span class="font-bold text-slate-900"><?= htmlspecialchars($g['nama']) ?></span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <?= $g['total_kelas'] ?? 0 ?> Kelas
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <?= $g['total_mapel'] ?? 0 ?> Mapel
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center space-x-1">
                                        <button type="button" 
                                                onclick="openEditGuruModal(<?= $g['id_guru'] ?>, '<?= htmlspecialchars(addslashes($g['nip'])) ?>', '<?= htmlspecialchars(addslashes($g['nama'])) ?>')" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="triggerDelete('<?= url('admin/guruDelete/' . $g['id_guru']) ?>', 'Hapus Guru', 'Apakah Anda yakin ingin menghapus data guru <?= htmlspecialchars(addslashes($g['nama'])) ?>? Semua jadwal dan nilai terkait juga akan terhapus.')" 
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

<!-- Modal Tambah Guru -->
<div id="addGuruModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Guru Baru</h3>
            <button type="button" onclick="closeModal('addGuruModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/guruStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIP Guru</label>
                <input type="text" name="nip" required placeholder="Contoh: 198501152010011001"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" required placeholder="Contoh: Drs. Budi Santoso, M.Pd"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password Akun</label>
                <input type="password" name="password" required placeholder="Kata sandi untuk login guru..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addGuruModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Guru
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Guru -->
<div id="editGuruModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Data Guru</h3>
            <button type="button" onclick="closeModal('editGuruModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/guruUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_guru" id="edit_id_guru">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIP Guru</label>
                <input type="text" name="nip" id="edit_nip" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" id="edit_nama" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Password Baru <span class="text-slate-400 text-[11px] font-normal">(Kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editGuruModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
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
    function openAddGuruModal() {
        openModal('addGuruModal');
    }

    function openEditGuruModal(id, nip, nama) {
        document.getElementById('edit_id_guru').value = id;
        document.getElementById('edit_nip').value = nip;
        document.getElementById('edit_nama').value = nama;
        openModal('editGuruModal');
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
