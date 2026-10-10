
<main class="flex-1 flex flex-col overflow-y-auto bg-[#030712] text-slate-100 min-h-screen">
    <div class="p-6 md:p-8 max-w-4xl mx-auto w-full space-y-6">
        
        <!-- Header Halaman -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-2xl font-extrabold text-white tracking-wide">Tambah Materi Baru</h1>
                <p class="text-xs text-slate-400 mt-1">Buat materi pembelajaran dan tenggat waktu tugas untuk siswa.</p>
            </div>
            <a href="index.php?url=guru/materi" 
               class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-900 border border-slate-800 rounded-xl hover:bg-slate-800 hover:text-white transition duration-200">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-[#090d16]/80 border border-slate-800/80 rounded-2xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
            <form action="index.php?url=guru/tambah_materi" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <!-- Judul Materi -->
                <div>
                    <label for="judul" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Judul Materi <span class="text-rose-500">*</span></label>
                    <input type="text" id="judul" name="judul" required placeholder="Contoh: BAB 1 : Pecahan Desimal"
                           class="w-full px-4 py-3 bg-slate-900/90 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200">
                </div>

                <!-- Dropdown Mata Pelajaran -->
                <div>
                    <label for="id_mapel" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Mata Pelajaran <span class="text-rose-500">*</span></label>
                    <select id="id_mapel" name="id_mapel" required
                            class="w-full px-4 py-3 bg-slate-900/90 border border-slate-800 rounded-xl text-sm text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200">
                        <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                        <?php foreach ($data['mapel'] as $mapel) : ?>
                            <option value="<?= $mapel['id_mapel']; ?>">
                                <?= htmlspecialchars($mapel['nama_mapel']); ?> (ID: #<?= $mapel['id_mapel']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Isi / Uraian Materi -->
                <div>
                    <label for="materi" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Isi Ringkasan Materi <span class="text-rose-500">*</span></label>
                    <textarea id="materi" name="materi" rows="4" required placeholder="Tuliskan uraian ringkas materi atau instruksi untuk siswa..."
                              class="w-full px-4 py-3 bg-slate-900/90 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200"></textarea>
                </div>

                <!-- Grid 2 Kolom untuk File Uploads -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- File Lampiran (Dokumen/Video) -->
                    <div>
                        <label for="file_path" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">File Lampiran (PDF/MP4)</label>
                        <div class="relative">
                            <input type="file" id="file_path" name="file_path" accept=".pdf,.doc,.docx,.mp4"
                                   class="w-full px-4 py-2.5 bg-slate-900/90 border border-slate-800 rounded-xl text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-400 hover:file:bg-indigo-600/30 cursor-pointer border-dashed">
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1">Format disarankan: PDF atau MP4.</p>
                    </div>

                    <!-- Upload Gambar / Thumbnail -->
                    <div>
                        <label for="gambar" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Gambar Sampul / Visual</label>
                        <div class="relative">
                            <input type="file" id="gambar" name="gambar" accept="image/*"
                                   class="w-full px-4 py-2.5 bg-slate-900/90 border border-slate-800 rounded-xl text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-cyan-600/20 file:text-cyan-400 hover:file:bg-cyan-600/30 cursor-pointer border-dashed">
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1">Format: JPG, PNG, WEBP.</p>
                    </div>
                </div>

                <!-- Tenggat Waktu -->
                <div>
                    <label for="tenggat_waktu" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Tenggat Waktu / Batas Kumpul <span class="text-rose-500">*</span></label>
                    <input type="datetime-local" id="tenggat_waktu" name="tenggat_waktu" 
                           class="w-full md:w-1/2 px-4 py-3 bg-slate-900/90 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200 [color-scheme:dark]">
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <button type="reset" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition duration-200">
                        Reset Form
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-cyan-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-cyan-500/30 transition duration-300 flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan Materi
                    </button>
                </div>

            </form>
        </div>

    </div>
</main>