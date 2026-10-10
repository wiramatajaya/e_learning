<body class="bg-[#0b0f19] text-slate-200 font-sans min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header Page -->
        <div class="flex items-center justify-between p-6">
            <h1 class="text-xl font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="text-cyan-400"></i> Buat Ujian & Soal Baru
            </h1>
            <a href="index.php?url=guru/quiz" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <!-- Tambahkan enctype multipart/form-data -->
        <form action="index.php?url=guru/tambah_quiz" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="w-full flex justify-center gap-5">
            <!-- BAGIAN 1: INFORMASI UJIAN -->
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl space-y-4">
                    <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider border-b border-slate-800 pb-3">
                        1. Pengaturan Ujian
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Judul Ujian</label>
                            <input type="text" name="judul_ujian" placeholder="Contoh: UH 1 Biologi - Sel" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
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
                            <label class="block text-xs text-slate-400 mb-1">Kategori / Kode Ujian</label>
                            <input type="text" name="jenis_ujian" placeholder="UH / UTS / UAS / ESAI" maxlength="4" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Waktu Pengerjaan</label>
                            <input type="time" name="wktu_pengerjaan" step="1" value="01:00:00" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal Pelaksanaan</label>
                            <input type="datetime-local" name="tgl_pelaksanaan" value="<?= date('Y-m-d\TH:i'); ?>" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal Pengumpulan / Tenggat</label>
                            <input type="date" name="tgl_pengumpulan" value="<?= date('Y-m-d'); ?>" required class="w-full bg-[#101626] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-cyan-500">
                        </div>
                    </div>

                    <!-- PILIHAN TIPE UJIAN -->
                    <div class="pt-2 border-t border-slate-800/60 mt-4">
                        <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">Tipe Soal Ujian</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-3 p-3 bg-[#101626] border border-slate-800 rounded-xl cursor-pointer hover:border-cyan-500/50 transition">
                                <input type="radio" name="tipe_soal" value="pg" checked onchange="switchTipeSoal('pg')" class="accent-cyan-500 w-4 h-4">
                                <div>
                                    <p class="text-xs font-bold text-white">Pilihan Ganda</p>
                                    <p class="text-[10px] text-slate-400">Soal dengan opsi A, B, C, D & kunci jawaban</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-3 bg-[#101626] border border-slate-800 rounded-xl cursor-pointer hover:border-cyan-500/50 transition">
                                <input type="radio" name="tipe_soal" value="esai" onchange="switchTipeSoal('esai')" class="accent-cyan-500 w-4 h-4">
                                <div>
                                    <p class="text-xs font-bold text-white">Upload File / Esai</p>
                                    <p class="text-[10px] text-slate-400">Siswa mengunggah berkas jawaban (PDF/Doc/Gambar)</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2A: CONTAINER SOAL PILIHAN GANDA -->
                <div id="section-pg" class="bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                        <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider">
                            2. Bank Soal Pilihan Ganda
                        </h2>
                        <button type="button" onclick="addSoalBlock()" class="px-3 py-1.5 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 rounded-lg text-xs font-bold hover:bg-cyan-500/20 transition flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Soal
                        </button>
                    </div>

                    <div id="container-soal" class="space-y-6">
                        <!-- Soal Pertama Default -->
                        <div class="soal-card bg-[#101626]/50 border border-slate-800 rounded-xl p-5 space-y-4 relative">
                            <span class="text-xs font-bold text-indigo-400 uppercase">Soal Nomor <span class="soal-index">1</span></span>
                            
                            <div>
                                <textarea name="soal[0][pertanyaan]" placeholder="Tuliskan pertanyaan di sini..." class="input-pg w-full bg-[#0b0f19] border border-slate-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-indigo-500" rows="2" required></textarea>
                            </div>

                            <!-- Input Gambar Soal -->
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Gambar Soal (Opsional)</label>
                                <input type="file" name="gambar_soal_0" accept="image/*" class="w-full text-xs text-slate-400 bg-[#0b0f19] border border-slate-800 rounded-lg p-2 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" name="soal[0][opsi_a]" placeholder="Opsi A" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                                <input type="text" name="soal[0][opsi_b]" placeholder="Opsi B" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                                <input type="text" name="soal[0][opsi_c]" placeholder="Opsi C" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                                <input type="text" name="soal[0][opsi_d]" placeholder="Opsi D" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                            </div>

                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Jawaban Benar</label>
                                <select name="soal[0][jawaban_benar]" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-emerald-400 font-bold focus:outline-none" required>
                                    <option value="A">Jawaban A</option>
                                    <option value="B">Jawaban B</option>
                                    <option value="C">Jawaban C</option>
                                    <option value="D">Jawaban D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2B: CONTAINER SOAL ESAI -->
                <div id="section-esai" class="hidden bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 backdrop-blur-xl space-y-4">
                    <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider border-b border-slate-800 pb-3">
                        2. Instruksi Tugas / Soal Esai
                    </h2>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1">Petunjuk / Soal Esai</label>
                        <textarea id="input-petunjuk-esai" name="petunjuk_esai" placeholder="Tuliskan instruksi atau soal esai di sini..." class="w-full bg-[#101626] border border-slate-800 rounded-xl p-4 text-sm text-white focus:outline-none focus:border-cyan-500" rows="5"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 mb-1">Gambar/Lampiran Pendukung Esai (Opsional)</label>
                        <input type="file" name="gambar_esai" accept="image/*" class="w-full text-xs text-slate-400 bg-[#101626] border border-slate-800 rounded-lg p-2 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20">
                    </div>
                    <p class="text-xs text-slate-500 italic">* Siswa nantinya akan diberikan tombol untuk mengunggah file pada kuis ini.</p>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-slate-950 font-extrabold text-xs uppercase tracking-widest rounded-xl transition shadow-lg">
                Simpan Ujian & Soal
            </button>
        </form>
    </div>

    <!-- Script Dynamic Form -->
    <script>
        lucide.createIcons();
        let countSoal = 1;

        function switchTipeSoal(tipe) {
            const sectionPg = document.getElementById('section-pg');
            const sectionEsai = document.getElementById('section-esai');
            const inputsPg = document.querySelectorAll('.input-pg');
            const inputEsai = document.getElementById('input-petunjuk-esai');

            if (tipe === 'pg') {
                sectionPg.classList.remove('hidden');
                sectionEsai.classList.add('hidden');
                inputsPg.forEach(el => el.setAttribute('required', 'required'));
                inputEsai.removeAttribute('required');
            } else {
                sectionPg.classList.add('hidden');
                sectionEsai.classList.remove('hidden');
                inputsPg.forEach(el => el.removeAttribute('required'));
                inputEsai.setAttribute('required', 'required');
            }
        }

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
                    <textarea name="soal[${countSoal}][pertanyaan]" placeholder="Tuliskan pertanyaan di sini..." class="input-pg w-full bg-[#0b0f19] border border-slate-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-indigo-500" rows="2" required></textarea>
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Gambar Soal (Opsional)</label>
                    <input type="file" name="gambar_soal_${countSoal}" accept="image/*" class="w-full text-xs text-slate-400 bg-[#0b0f19] border border-slate-800 rounded-lg p-2 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input type="text" name="soal[${countSoal}][opsi_a]" placeholder="Opsi A" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                    <input type="text" name="soal[${countSoal}][opsi_b]" placeholder="Opsi B" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                    <input type="text" name="soal[${countSoal}][opsi_c]" placeholder="Opsi C" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                    <input type="text" name="soal[${countSoal}][opsi_d]" placeholder="Opsi D" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-white" required>
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Jawaban Benar</label>
                    <select name="soal[${countSoal}][jawaban_benar]" class="input-pg bg-[#0b0f19] border border-slate-800 rounded-lg px-3 py-2 text-xs text-emerald-400 font-bold focus:outline-none" required>
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
            
            document.querySelectorAll('.soal-card').forEach((el, idx) => {
                el.querySelector('.soal-index').innerText = idx + 1;
            });
        }
    </script>
</body>