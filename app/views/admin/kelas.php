<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-slate-900">Daftar Kelas Sekolah</h2>
            <p class="text-xs text-slate-500">Kelola data pembagian rombel dan kelas akademik</p>
        </div>

        <button type="button" onclick="openAddKelasModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Kelas Baru</span>
        </button>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($kelasList)): ?>
            <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-3xl border border-slate-200">
                Belum ada data kelas yang terdaftar.
            </div>
        <?php else: ?>
            <?php foreach ($kelasList as $k): ?>
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-700 flex items-center justify-center">
                                <i data-lucide="door-open" class="w-6 h-6"></i>
                            </div>
                            <div class="flex items-center space-x-1">
                                <button type="button" 
                                        onclick="openEditKelasModal(<?= $k['id_kelas'] ?>, '<?= htmlspecialchars(addslashes($k['nama'])) ?>')" 
                                        class="p-2 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button type="button" 
                                        onclick="triggerDelete('<?= url('admin/kelasDelete/' . $k['id_kelas']) ?>', 'Hapus Kelas', 'Apakah Anda yakin ingin menghapus kelas <?= htmlspecialchars(addslashes($k['nama'])) ?>? Seluruh siswa dan jadwal di kelas ini akan terhapus.')" 
                                        class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 mb-1"><?= htmlspecialchars($k['nama']) ?></h3>
                        <p class="text-xs text-slate-400">ID Kelas: #<?= $k['id_kelas'] ?></p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 grid grid-cols-2 gap-3 text-center">
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-lg font-bold text-slate-800"><?= $k['total_siswa'] ?? 0 ?></p>
                            <p class="text-[11px] font-medium text-slate-500">Siswa Aktif</p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-lg font-bold text-indigo-600"><?= $k['total_jadwal'] ?? 0 ?></p>
                            <p class="text-[11px] font-medium text-slate-500">Sesi Jadwal</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<!-- Modal Tambah Kelas -->
<div id="addKelasModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Kelas Baru</h3>
            <button type="button" onclick="closeModal('addKelasModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/kelasStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kelas</label>
                <input type="text" name="nama" required placeholder="Contoh: X RPL 1 atau 12 MIPA 2"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addKelasModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Kelas
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Kelas -->
<div id="editKelasModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Nama Kelas</h3>
            <button type="button" onclick="closeModal('editKelasModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/kelasUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_kelas" id="edit_id_kelas">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Kelas</label>
                <input type="text" name="nama" id="edit_kelas_nama" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editKelasModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
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
    function openAddKelasModal() {
        openModal('addKelasModal');
    }

    function openEditKelasModal(id, nama) {
        document.getElementById('edit_id_kelas').value = id;
        document.getElementById('edit_kelas_nama').value = nama;
        openModal('editKelasModal');
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
