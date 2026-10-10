<?php ?>

<div class="p-6 font-sans text-white min-h-screen bg-transparent space-y-6">
   <!-- HEADERRRS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-cyan-500/40 transition-all duration-300">
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-indigo-500"></div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Materi</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-white"><?= count($data['pelajaran'] ?? []) ?> Mapel</span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500"></span>
                    </div>
                    <span class="text-[10px] font-medium text-slate-400 block mt-1.5 bg-cyan-500/10 text-cyan-300 px-2 py-0.5 rounded-md w-max">Telah Selesai</span>
                </div>
                <div class="bg-cyan-500/10 text-cyan-400 p-3.5 rounded-xl border border-cyan-500/20 shadow-[0_0_20px_rgba(6,182,212,0.15)]"><i data-lucide="book-open" class="w-6 h-6"></i></div>
            </div>
        </div>
        <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-amber-500/40 transition-all duration-300">
            <div class="h-1 bg-gradient-to-r from-amber-500 to-orange-500"></div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest">Total Materi</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-amber-400"><?= $data['statistik']['total_Materi']['total_semua'] ?? 0 ?> Materi</span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500"><?= $data['statistik']['total_Materi']['total_semua'] ?? 0 ?> File</span>
                    </div>
                    <span class="text-[10px] font-medium text-slate-400 block mt-1.5 bg-amber-500/10 text-amber-300 px-2 py-0.5 rounded-md w-max">Perlu Dikerjakan</span>
                </div>
                <div class="bg-amber-500/10 text-amber-400 p-3.5 rounded-xl border border-amber-500/20 shadow-[0_0_20px_rgba(245,158,11,0.15)]"><i data-lucide="file-text" class="w-6 h-6"></i></div>
            </div>
        </div>
                <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-indigo-500/40 transition-all duration-300">
            <div class="h-1 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Quiz Saat Ini</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-white"><?= $data['statistik']['total_ujian']['total_semua'] ?? 0 ?> Sesi</span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500">10</span>
                    </div>
                    <span class="text-[10px] font-medium text-slate-400 block mt-1.5 bg-indigo-500/10 text-indigo-300 px-2 py-0.5 rounded-md w-max">Total Tatap Muka</span>
                </div>
                <div class="bg-indigo-500/10 text-indigo-400 p-3.5 rounded-xl border border-indigo-500/20 shadow-[0_0_20px_rgba(99,102,241,0.15)]"><i data-lucide="video" class="w-6 h-6"></i></div>
            </div>
        </div>
    </div>
    <!-- Navigasi Tab & Tombol Aksi Tambah -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-800 pb-2">
            <p  class=" text-base font-semibold text-white  focus:outline-none" > Daftar Pelajaran</p>
        <!-- FITUR BARU: Tombol Tambah Pelajaran Baru -->
        <button onclick="openModal('add')" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs tracking-wide rounded-lg shadow-lg shadow-blue-500/10 transition-all cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i> TAMBAH MAPEL
        </button>
    </div>

    <!-- Konten Tab Materi -->
    <div id="tab-materi" class="tab-content block">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach($data['pelajaran'] as $p) :?>
            <div class="bg-[#161b26] rounded-xl p-5 border border-gray-800 flex flex-col justify-between group hover:border-gray-700 transition-all">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-base font-bold text-white group-hover:text-blue-400 transition-colors"><?= $p["nama_mapel"] ?></h3>
                                <span class="text-[10px] text-gray-600 font-mono block mt-0.5">Kelas: <?= $_SESSION["kelas_id"] ?></span>
                            </div>
                            
                            <!-- FITUR BARU: Menu dropdown mini Aksi Guru (Edit & Hapus) -->
                            <div class="flex items-center gap-1 bg-[#0b0e14] p-1 rounded-lg border border-gray-800">
                                <button onclick="openModal('edit', '<?= $p['id_mapel'] ?>', '<?= addslashes($p['nama_mapel']) ?>', '<?= addslashes($p['deskripsi']) ?>')" class="p-1.5 text-gray-400 hover:text-amber-400 rounded transition-colors" title="Edit Pelajaran">
                                    <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                </button>
                                <a href="index.php?url=guru/hapus_mapel&id=<?= $p['id_mapel'] ?>" onclick="return confirm('Hapus mata pelajaran ini beserta semua materi di dalamnya?')" class="p-1.5 text-gray-400 hover:text-rose-500 rounded transition-colors" title="Hapus Pelajaran">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>

                        <p class="text-sm text-gray-400 font-medium mb-4 line-clamp-2 min-h-[40px]"><?= $p['deskripsi'] ?></p>
                        
                        <div class="flex justify-between text-[11px] text-gray-500 mb-1.5 font-medium">
                            <span>Progres Unggahan</span>
                            <span class="text-blue-400">6 / 12 Selesai</span>
                        </div>
                        <div class="w-full bg-[#0b0e14] h-1.5 rounded-full mb-5 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full rounded-full" style="width: 50%;"></div>
                        </div>
                    </div>
                    
                    <a href="index.php?url=guru/materi&id=<?= $p["id_mapel"]?>" class="text-center bg-[#0b0e14] hover:bg-blue-500 border border-blue-500/30 hover:border-blue-500 text-blue-400 hover:text-white font-bold text-xs tracking-wide py-2.5 px-4 rounded-lg transition-all flex items-center justify-center gap-2">
                        <i data-lucide="folder-open" class="w-3.5 h-3.5"></i> KELOLA MATERI
                    </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- FITUR BARU: MODAL INTERAKTIF (Bisa untuk Tambah dan Edit sekaligus) -->
<div id="mapel-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-[#161b26] border border-gray-800 w-full max-w-md p-6 rounded-xl shadow-2xl space-y-4">
        <div class="flex justify-between items-center border-b border-gray-800 pb-3">
            <h3 id="modal-title" class="text-base font-bold text-white">Tambah Pelajaran</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
        </div>
        
        <form id="modal-form" action="index.php?url=guru/simpan_mapel" method="POST" class="space-y-4">
            <input type="hidden" name="id_mapel" id="form-id">
            
            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1.5">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="form-nama" required placeholder="Contoh: Matematika Peminatan" class="w-full bg-[#0b0e14] border border-gray-800 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1.5">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="form-deskripsi" rows="3" required placeholder="Jelaskan silabus ringkas pelajaran..." class="w-full bg-[#0b0e14] border border-gray-800 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold text-xs rounded-lg transition-colors">BATAL</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold text-xs rounded-lg transition-colors">SIMPAN DATA</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT UNTUK ATUR MODAL DAN POPULASI DATA EDIT -->
<script>
function openModal(mode, id = '', nama = '', deskripsi = '') {
    const modal = document.getElementById('mapel-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('modal-form');
    
    document.getElementById('form-id').value = id;
    document.getElementById('form-nama').value = nama;
    document.getElementById('form-deskripsi').value = deskripsi;

    if (mode === 'edit') {
        title.innerText = 'Ubah Mata Pelajaran';
        form.action = 'index.php?url=guru/edit_mapel';
    } else {
        title.innerText = 'Tambah Pelajaran Baru';
        form.action = 'index.php?url=guru/edit_mapel';
    }

    modal.classList.remove('hidden');
    setTimeout(() => modal.classList.remove('opacity-0'), 10);
    lucide.createIcons();
}

function closeModal() {
    const modal = document.getElementById('mapel-modal');
    modal.classList.add('opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
</script>
