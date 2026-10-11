<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-slate-900">Akun Administrator</h2>
            <p class="text-xs text-slate-500">Kelola pengguna dengan hak akses penuh ke panel master</p>
        </div>

        <button type="button" onclick="openAddAccountModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Admin Baru</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">ID</th>
                        <th class="py-4 px-6">Username</th>
                        <th class="py-4 px-6">Dibuat Pada</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($adminList as $a): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-6 text-slate-400 font-mono font-medium">#<?= $a['id_admin'] ?></td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs border border-amber-200/50">
                                        <i data-lucide="shield" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900"><?= htmlspecialchars($a['username']) ?></p>
                                        <?php if ((int)$a['id_admin'] === (int)($_SESSION['user_id'] ?? 0)): ?>
                                            <span class="inline-flex items-center px-2 py-0.2 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Akun Anda Saat Ini
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-500 text-xs">
                                <?= date('d M Y, H:i', strtotime($a['created_at'] ?? 'now')) ?>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center space-x-1">
                                    <button type="button" 
                                            onclick="openEditAccountModal(<?= $a['id_admin'] ?>, '<?= htmlspecialchars(addslashes($a['username'])) ?>')" 
                                            class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </button>
                                    <?php if ((int)$a['id_admin'] !== (int)($_SESSION['user_id'] ?? 0)): ?>
                                        <button type="button" 
                                                onclick="triggerDelete('<?= url('admin/accountDelete/' . $a['id_admin']) ?>', 'Hapus Admin', 'Apakah Anda yakin ingin menghapus akun admin <?= htmlspecialchars(addslashes($a['username'])) ?>?')" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah Admin -->
<div id="addAccountModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Akun Admin</h3>
            <button type="button" onclick="closeModal('addAccountModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/accountStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" required placeholder="Contoh: admin_utama"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required placeholder="Kata sandi akun admin..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addAccountModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Admin -->
<div id="editAccountModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Akun Admin</h3>
            <button type="button" onclick="closeModal('editAccountModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/accountUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_admin" id="edit_id_admin">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" id="edit_account_username" required
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
                <button type="button" onclick="closeModal('editAccountModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
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
    function openAddAccountModal() {
        openModal('addAccountModal');
    }

    function openEditAccountModal(id, username) {
        document.getElementById('edit_id_admin').value = id;
        document.getElementById('edit_account_username').value = username;
        openModal('editAccountModal');
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
