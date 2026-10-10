

    <div class="w-full mx-auto space-y-6 mt-5">
        
        <!-- Header Page -->
        <div class="flex items-center justify-between px-10">
            <h1 class="text-xl font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="text-cyan-400"></i> Buat Ujian & Soal Baru
            </h1>
            <a href="index.php?url=guru/tambah_quiz" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <form action="index.php?url=guru/tambah_quiz" method="POST" class="space-y-6 w-full ">
            <div class="w-full flex justify-center  flex gap-6">
                <div class="bg-slate-900/40 min-h-[25rem] border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl space-y-4">
                    <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider border-b border-slate-800 pb-3">
                        1. Pengaturan Ujian
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Judul Ujian</label>
                            <input type="text" name="judul_ujian" placeholder="Contoh: Kuis UH 1 Biologi" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Mata Pelajaran</label>
                            <select name="id_mapel" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                                <option value="">-- Pilih Mapel --</option>
                                <?php foreach ($data['pelajaran'] as $p) : ?>
                                    <option value="<?= $p['id_mapel']; ?>"><?= htmlspecialchars($p['nama_mapel']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Jenis Ujian</label>
                            <input type="text" name="jenis_ujian" placeholder="UH / UTS / UAS" maxlength="4" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Waktu Pengerjaan</label>
                            <input type="time" name="wktu_pengerjaan" step="1" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal Pelaksanaan</label>
                            <input type="datetime-local" name="tgl_pelaksanaan" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal Pengumpulan / Tenggat</label>
                            <input type="date" name="tgl_pengumpulan" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>
                    </div>
                </div>

            <!-- BAGIAN 2: DAFTAR SOAL (DYNAMIC) -->
                <div class="bg-slate-900/40 min-h-[25rem] border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                        <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider">
                            2. Bank Soal Ganda
                        </h2>
                        <button type="button" onclick="addSoalBlock()" class="px-3 py-1.5 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 rounded-lg text-xs font-bold hover:bg-cyan-500/20 transition flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Soal
                        </button>
                    </div>

                    <!-- Container Blok Soal -->
                    <div id="container-soal" class="space-y-6">
                        <!-- Soal Pertama Default -->
                        <div class="soal-card bg-[#101626]/50 border border-slate-800 rounded-xl p-5 space-y-4 relative">
                            <span class="text-xs font-bold text-indigo-400 uppercase">Soal Nomor <span class="soal-index">1</span></span>
                            
                            <div>
                                <textarea name="soal[0][pertanyaan]" placeholder="Tuliskan pertanyaan di sini..." required class="w-full bg-[#0b0f19] border border-slate-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-indigo-500" rows="2"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" name="soal[0][opsi_a]" placeholder="Opsi A" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                                <input type="text" name="soal[0][opsi_b]" placeholder="Opsi B" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                                <input type="text" name="soal[0][opsi_c]" placeholder="Opsi C" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                                <input type="text" name="soal[0][opsi_d]" placeholder="Opsi D" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                            </div>

                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Jawaban Benar</label>
                                <select name="soal[0][jawaban_benar]" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-emerald-400 font-bold focus:outline-none">
                                    <option value="A">Jawaban A</option>
                                    <option value="B">Jawaban B</option>
                                    <option value="C">Jawaban C</option>
                                    <option value="D">Jawaban D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BAGIAN 1: INFORMASI UJIAN -->


            <!-- Submit Button -->
            <button type="submit" class="w-[75%] py-3.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-slate-950 font-extrabold text-xs uppercase tracking-widest rounded-xl transition shadow-lg">
                Simpan Ujian & Semua Soal
            </button>
        </form>
    </div>

    <!-- Script Dynamic Form Soal -->
    <script>
        lucide.createIcons();
        let countSoal = 1;

        function addSoalBlock() {
            const container = document.getElementById('container-soal');
            const newCard = document.createElement('div');
            newCard.className = 'soal-card bg-[#101626]/50 border border-slate-800 rounded-xl p-5 space-y-4 relative';
            
            newCard.innerHTML = `
                <div class="flex justify-between items-center">
                    <span class="text-xs font-bold text-indigo-400 uppercase">Soal Nomor <span class="soal-index">${countSoal + 1}</span></span>
                    <button type="button" onclick="removeSoalBlock(this)" class="text-rose-400 hover:text-rose-300 text-xs font-bold flex items-center gap-1">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                    </button>
                </div>
                <div>
                    <textarea name="soal[${countSoal}][pertanyaan]" placeholder="Tuliskan pertanyaan di sini..." required class="w-full bg-[#0b0f19] border border-slate-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-indigo-500" rows="2"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input type="text" name="soal[${countSoal}][opsi_a]" placeholder="Opsi A" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                    <input type="text" name="soal[${countSoal}][opsi_b]" placeholder="Opsi B" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                    <input type="text" name="soal[${countSoal}][opsi_c]" placeholder="Opsi C" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                    <input type="text" name="soal[${countSoal}][opsi_d]" placeholder="Opsi D" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Jawaban Benar</label>
                    <select name="soal[${countSoal}][jawaban_benar]" required class="bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-emerald-400 font-bold focus:outline-none">
                        <option value="A">Jawaban A</option>
                        <option value="B">Jawaban B</option>
                        <option value="C">Jawaban C</option>
                        <option value="D">Jawaban D</option>
                    </select>
                </div>
            `;

            container.appendChild(newCard);
            countSoal++;
            lucide.createIcons();
        }

        function removeSoalBlock(button) {
            const card = button.closest('.soal-card');
            card.remove();
            
            // Re-indexing nomor tampilan soal
            document.querySelectorAll('.soal-card').forEach((el, idx) => {
                el.querySelector('.soal-index').innerText = idx + 1;
            });
        }
    </script>
