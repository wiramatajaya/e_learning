<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input type="text" id="pelajaranSearch" onkeyup="filterTable('pelajaranSearch', 'pelajaranTable')" 
                   placeholder="Cari mata pelajaran..."
                   class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 focus:bg-white transition-all">
        </div>

        <button type="button" onclick="openAddPelajaranModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Mata Pelajaran</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="pelajaranTable">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">ID</th>
                        <th class="py-4 px-6">Nama Mata Pelajaran</th>
                        <th class="py-4 px-6">Cakupan Pembelajaran</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($pelajaranList)): ?>
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400">Belum ada mata pelajaran.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pelajaranList as $p): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-4 px-6 text-slate-400 font-mono font-medium">#<?= $p['pelajaran_id'] ?></td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                                            <i data-lucide="book" class="w-4 h-4"></i>
                                        </div>
                                        <span class="font-bold text-slate-900"><?= htmlspecialchars($p['nama_pelajaran']) ?></span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            <?= $p['total_guru'] ?? 0 ?> Guru Pengampu
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <?= $p['total_kelas'] ?? 0 ?> Kelas Terjadwal
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center space-x-1">
                                        <button type="button" 
                                                onclick="openEditPelajaranModal(<?= $p['pelajaran_id'] ?>, '<?= htmlspecialchars(addslashes($p['nama_pelajaran'])) ?>')" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="triggerDelete('<?= url('admin/pelajaranDelete/' . $p['pelajaran_id']) ?>', 'Hapus Pelajaran', 'Apakah Anda yakin ingin menghapus mata pelajaran <?= htmlspecialchars(addslashes($p['nama_pelajaran'])) ?>? Semua jadwal dan nilai terkait akan terhapus.')" 
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

<!-- Modal Tambah Pelajaran -->
<div id="addPelajaranModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Mata Pelajaran</h3>
            <button type="button" onclick="closeModal('addPelajaranModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/pelajaranStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Mata Pelajaran</label>
                <input type="text" name="nama_pelajaran" required placeholder="Contoh: Pemrograman Web"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addPelajaranModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Pelajaran
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pelajaran -->
<div id="editPelajaranModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Mata Pelajaran</h3>
            <button type="button" onclick="closeModal('editPelajaranModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/pelajaranUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="pelajaran_id" id="edit_pelajaran_id">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Mata Pelajaran</label>
                <input type="text" name="nama_pelajaran" id="edit_nama_pelajaran" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editPelajaranModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
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
    function openAddPelajaranModal() {
        openModal('addPelajaranModal');
    }

    function openEditPelajaranModal(id, nama) {
        document.getElementById('edit_pelajaran_id').value = id;
        document.getElementById('edit_nama_pelajaran').value = nama;
        openModal('editPelajaranModal');
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
