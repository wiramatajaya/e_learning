<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="space-y-6">

    <!-- Top Action & Filter Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex flex-wrap gap-3 flex-1 items-center">
            <!-- Day Filter -->
            <select id="filterHari" onchange="filterJadwalTable()" class="px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>

            <!-- Class Filter -->
            <select id="filterKelas" onchange="filterJadwalTable()" class="px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Kelas</option>
                <?php foreach ($kelasList as $k): ?>
                    <option value="<?= htmlspecialchars($k['nama']) ?>"><?= htmlspecialchars($k['nama']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Search Filter -->
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="jadwalSearch" onkeyup="filterJadwalTable()" 
                       placeholder="Cari mapel atau guru..."
                       class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 focus:bg-white transition-all">
            </div>
        </div>

        <button type="button" onclick="openAddJadwalModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all flex-shrink-0">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            <span>Tambah Jadwal Baru</span>
        </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="jadwalTable">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 text-xs uppercase font-bold tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Hari & Waktu</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6">Mata Pelajaran</th>
                        <th class="py-4 px-6">Guru Pengampu</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($jadwalList)): ?>
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada jadwal pelajaran yang ditentukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($jadwalList as $j): ?>
                            <?php 
                                $dayColors = [
                                    'Senin' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                    'Selasa' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'Rabu' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'Kamis' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'Jumat' => 'bg-purple-50 text-purple-700 border-purple-200',
                                    'Sabtu' => 'bg-rose-50 text-rose-700 border-rose-200',
                                ];
                                $badgeStyle = $dayColors[$j['hari']] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                            ?>
                            <tr class="hover:bg-slate-50/60 transition-colors" data-hari="<?= htmlspecialchars($j['hari']) ?>" data-kelas="<?= htmlspecialchars($j['nama_kelas']) ?>">
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold border <?= $badgeStyle ?>">
                                            <?= htmlspecialchars($j['hari']) ?>
                                        </span>
                                        <div class="text-xs">
                                            <p class="font-bold text-slate-800"><?= htmlspecialchars($j['jam']) ?></p>
                                            <?php if (!empty($j['menit'])): ?>
                                                <p class="text-[11px] text-slate-400"><?= htmlspecialchars($j['menit']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-bold bg-slate-100 text-slate-800">
                                        <?= htmlspecialchars($j['nama_kelas']) ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-bold text-slate-900"><?= htmlspecialchars($j['nama_pelajaran']) ?></p>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-medium text-slate-700 text-xs"><?= htmlspecialchars($j['nama_guru']) ?></p>
                                    <p class="text-[10px] text-slate-400 font-mono">NIP: <?= htmlspecialchars($j['nip_guru']) ?></p>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center space-x-1">
                                        <button type="button" 
                                                onclick="openEditJadwalModal(<?= $j['jadwal_id'] ?>, '<?= htmlspecialchars(addslashes($j['hari'])) ?>', '<?= htmlspecialchars(addslashes($j['jam'])) ?>', '<?= htmlspecialchars(addslashes($j['menit'])) ?>', <?= $j['id_kelas'] ?>, <?= $j['pelajaran_id'] ?>, <?= $j['id_guru'] ?>)" 
                                                class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors" title="Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="triggerDelete('<?= url('admin/jadwalDelete/' . $j['jadwal_id']) ?>', 'Hapus Jadwal', 'Apakah Anda yakin ingin menghapus jadwal ini?')" 
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

<!-- Modal Tambah Jadwal -->
<div id="addJadwalModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Jadwal Pelajaran</h3>
            <button type="button" onclick="closeModal('addJadwalModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/jadwalStore') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hari</label>
                    <select name="hari" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Pelajaran</label>
                    <input type="text" name="jam" required placeholder="07:30 - 09:00"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durasi (Menit)</label>
                <input type="text" name="menit" placeholder="Contoh: 90 menit"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kelas</label>
                <select name="id_kelas" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelasList as $k): ?>
                        <option value="<?= $k['id_kelas'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                <select name="pelajaran_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    <?php foreach ($pelajaranList as $p): ?>
                        <option value="<?= $p['pelajaran_id'] ?>"><?= htmlspecialchars($p['nama_pelajaran']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Guru Pengampu</label>
                <select name="id_guru" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="">-- Pilih Guru --</option>
                    <?php foreach ($guruList as $g): ?>
                        <option value="<?= $g['id_guru'] ?>"><?= htmlspecialchars($g['nama']) ?> (NIP: <?= htmlspecialchars($g['nip']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addJadwalModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div id="editJadwalModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Perbarui Jadwal Pelajaran</h3>
            <button type="button" onclick="closeModal('editJadwalModal')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="<?= url('admin/jadwalUpdate') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="jadwal_id" id="edit_jadwal_id">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hari</label>
                    <select name="hari" id="edit_hari" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jam Pelajaran</label>
                    <input type="text" name="jam" id="edit_jam" required
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durasi (Menit)</label>
                <input type="text" name="menit" id="edit_menit"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kelas</label>
                <select name="id_kelas" id="edit_id_kelas" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <?php foreach ($kelasList as $k): ?>
                        <option value="<?= $k['id_kelas'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                <select name="pelajaran_id" id="edit_pelajaran_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <?php foreach ($pelajaranList as $p): ?>
                        <option value="<?= $p['pelajaran_id'] ?>"><?= htmlspecialchars($p['nama_pelajaran']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Guru Pengampu</label>
                <select name="id_guru" id="edit_id_guru" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <?php foreach ($guruList as $g): ?>
                        <option value="<?= $g['id_guru'] ?>"><?= htmlspecialchars($g['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('editJadwalModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
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
    function openAddJadwalModal() {
        openModal('addJadwalModal');
    }

    function openEditJadwalModal(id, hari, jam, menit, idKelas, pelId, idGuru) {
        document.getElementById('edit_jadwal_id').value = id;
        document.getElementById('edit_hari').value = hari;
        document.getElementById('edit_jam').value = jam;
        document.getElementById('edit_menit').value = menit;
        document.getElementById('edit_id_kelas').value = idKelas;
        document.getElementById('edit_pelajaran_id').value = pelId;
        document.getElementById('edit_id_guru').value = idGuru;
        openModal('editJadwalModal');
    }

    function filterJadwalTable() {
        const query = document.getElementById('jadwalSearch').value.toLowerCase();
        const hariVal = document.getElementById('filterHari').value;
        const kelasVal = document.getElementById('filterKelas').value;
        const rows = document.querySelectorAll('#jadwalTable tbody tr');

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowHari = row.getAttribute('data-hari') || '';
            const rowKelas = row.getAttribute('data-kelas') || '';

            const matchSearch = text.includes(query);
            const matchHari = !hariVal || rowHari === hariVal;
            const matchKelas = !kelasVal || rowKelas === kelasVal;

            if (matchSearch && matchHari && matchKelas) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
