<section class="bg-[#0b0f19] text-slate-200 font-sans min-h-screen p-4 md:p-8">

    <div class="max-w-3xl mx-auto bg-slate-900/50 border border-slate-800 rounded-2xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-800 pb-4 mb-6">
            <h1 class="text-xl font-bold text-white flex items-center gap-2">
                <i data-lucide="file-edit" class="text-indigo-400"></i> Edit Data Materi
            </h1>
            <a href="index.php?url=guru/materi" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <form action=<?="index.php?url=guru/edit_materi&id=".$data['materi']['id_materi']?> method="POST" enctype="multipart/form-data" class="space-y-5">
            <!-- Hidden ID Materi -->
            <input type="hidden" name="id_materi" value="<?= $data['materi']['id_materi']; ?>">

            <!-- Mata Pelajaran -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Mata Pelajaran</label>
                <select name="id_mapel" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500">
                    <?php foreach ($data['pelajaran'] as $p) : ?>
                        <option value="<?= $p['id_mapel']; ?>" <?= $p['id_mapel'] == $data['materi']['id_mapel'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($p['nama_mapel']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Judul Materi -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Judul Materi</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($data['materi']['judul']); ?>" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500">
            </div>

            <!-- Isi Materi -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Isi Materi</label>
                <textarea name="materi" rows="5" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500"><?= htmlspecialchars($data['materi']['materi']); ?></textarea>
            </div>

            <!-- Tenggat Waktu -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Tenggat Waktu</label>
                <input type="datetime-local" name="tenggat_waktu" value="<?= date('Y-m-d\TH:i', strtotime($data['materi']['tenggat_waktu'])); ?>" class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-indigo-500">
            </div>

            <!-- Upload File (PDF/Doc) & Gambar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">File Lampiran (Kosongkan jika tak diubah)</label>
                    <input type="file" name="file_path" class="w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                    <?php if (!empty($data['materi']['file_path'])) : ?>
                        <p class="text-[11px] text-slate-500 mt-1 truncate">File saat ini: <?= basename($data['materi']['file_path']); ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Gambar Sampul (Kosongkan jika tak diubah)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                    <?php if (!empty($data['materi']['gambar'])) : ?>
                        <p class="text-[11px] text-slate-500 mt-1 truncate">Gambar saat ini: <?= basename($data['materi']['gambar']); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>