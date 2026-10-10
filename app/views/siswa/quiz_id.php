<?php 
  $soal            = $data['soal'];
  $currentPage     = $data['current_page'];
  $totalSoal       = $data['total_soal'];
  $idUjian         = $data['id_ujian'];
  $jawabanTerpilih = $data['jawaban_terpilih'];
  $allSoal         = $data['all_soal'];
  $soalDijawab     = $data['soal_dijawab'];
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- KOLOM KIRI: SOAL & PILIHAN JAWABAN -->
    <div class="lg:col-span-2 space-y-5">
        <?php if ($soal) : ?>
            <form id="formQuiz" action="index.php?url=siswa/quiz&id=<?= $idUjian ?>&page=<?= $currentPage ?>" method="POST" class="space-y-5">
                <input type="hidden" name="id_soal" value="<?= $soal['id_soal'] ?>">
                <input type="hidden" id="next_page" name="next_page" value="<?= $currentPage ?>">

                <!-- Tampilan Pertanyaan -->
                <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-xl p-6 shadow-lg space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-800/60 pb-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">
                            Soal No. <?= $currentPage ?> dari <?= $totalSoal ?>
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ID Soal: #<?= $soal['id_soal'] ?></span>
                    </div>
                    
                    <p class="text-base md:text-lg text-white font-medium leading-relaxed">
                        <?= htmlspecialchars($soal['pertanyaan']) ?>
                    </p>
                </div>

                <!-- Opsi Jawaban (A, B, C, D) -->
                <div class="space-y-3">
                    <?php 
                    $opsi = [
                        'A' => $soal['opsi_a'],
                        'B' => $soal['opsi_b'],
                        'C' => $soal['opsi_c'],
                        'D' => $soal['opsi_d']
                    ];
                    foreach ($opsi as $key => $val) : 
                        $isChecked = ($jawabanTerpilih === $key) ? 'checked' : '';
                    ?>
                        <label class="flex items-center gap-4 p-4 bg-slate-900/30 hover:bg-slate-900/60 border border-slate-800 hover:border-slate-700/80 rounded-xl cursor-pointer transition group">
                            <input type="radio" name="jawaban" value="<?= $key ?>" <?= $isChecked ?> class="peer hidden" onchange="this.form.submit()">
                            
                            <div class="w-8 h-8 rounded-lg bg-[#101626] border border-slate-800 flex items-center justify-center text-xs font-bold text-slate-400 peer-checked:bg-gradient-to-tr peer-checked:from-cyan-500 peer-checked:to-indigo-500 peer-checked:text-slate-950 peer-checked:border-transparent transition">
                                <?= $key ?>
                            </div>
                            <span class="text-sm font-medium text-slate-300 group-hover:text-white transition">
                                <?= htmlspecialchars($val) ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <!-- TOMBOL NAVIGASI SOAL -->
                <div class="flex justify-between items-center pt-2">
                    <!-- Tombol Sebelumnya -->
                    <?php if ($currentPage > 1) : ?>
                        <button type="button" onclick="navigatePage(<?= $currentPage - 1 ?>)" 
                                class="px-5 py-2.5 rounded-xl border border-slate-800 bg-[#101626] hover:border-slate-700 text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition flex items-center gap-1.5">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i> Sebelumnya
                        </button>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <!-- Tombol Selanjutnya / Selesai -->
                    <?php if ($currentPage < $totalSoal) : ?>
                        <button type="button" onclick="navigatePage(<?= $currentPage + 1 ?>)" 
                                class="px-5 py-2.5 rounded-xl bg-[#101626] border border-slate-800 hover:border-slate-700 text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition flex items-center gap-1.5">
                            Selanjutnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    <?php else : ?>
                        <button type="submit" name="submit_quiz" value="1" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan kuis ini?')"
                                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-slate-950 font-bold text-xs uppercase tracking-wider hover:opacity-90 transition shadow-lg shadow-emerald-500/20">
                            Selesai & Kirim
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        <?php else : ?>
            <div class="p-6 bg-slate-900/40 rounded-2xl border border-slate-800 text-center text-slate-400">
                Belum ada soal pada ujian ini.
            </div>
        <?php endif; ?>
    </div>

    <!-- KOLOM KANAN: GRID NAVIGASI NOMOR SOAL -->
    <div class="space-y-6">
        <div class="bg-slate-900/40 p-5 rounded-2xl border border-slate-800/80 backdrop-blur-xl shadow-lg space-y-4">
            <h3 class="font-bold text-white text-xs uppercase tracking-wider flex items-center gap-2 border-b border-slate-800/60 pb-3">
                <i data-lucide="grid" class="w-4 h-4 text-cyan-400"></i> Navigasi Soal
            </h3>

            <!-- Grid Angka Nomor Soal -->
            <div class="grid grid-cols-5 gap-2.5 text-center">
                <?php 
                for ($i = 1; $i <= $totalSoal; $i++) : 
                    $soalItem = $allSoal[$i - 1];
                    $isSudahDijawab = in_array($soalItem['id_soal'], $soalDijawab);
                    
                    // Logika Style Nomor Ujian
                    if ($i == $currentPage && $isSudahDijawab) {
                        // Aktif + Sudah Dijawab (Hijau dengan border/ring Cyan)
                        $btnStyle = "bg-emerald-500/20 text-emerald-400 border-cyan-400 ring-2 ring-cyan-400/40";
                    } elseif ($i == $currentPage) {
                        // Aktif + Belum Dijawab (Gradient Cyan)
                        $btnStyle = "bg-gradient-to-tr from-cyan-500/20 to-indigo-500/20 text-cyan-400 border-cyan-500/40 ring-2 ring-cyan-400/30";
                    } elseif ($isSudahDijawab) {
                        // Sudah Dijawab (Hijau Emerald)
                        $btnStyle = "bg-emerald-500/20 text-emerald-400 border-emerald-500/40";
                    } else {
                        // Belum Dijawab (Default Dark)
                        $btnStyle = "bg-[#101626]/60 hover:bg-[#101626] text-slate-400 border-slate-800/80 hover:border-slate-700";
                    }
                ?>
                    <button type="button" onclick="navigatePage(<?= $i ?>)" 
                            class="aspect-square rounded-xl font-bold text-xs flex items-center justify-center transition border <?= $btnStyle ?>">
                        <?= $i ?>
                    </button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<script>
function navigatePage(pageNumber) {
    document.getElementById('next_page').value = pageNumber;
    document.getElementById('formQuiz').submit();
}
</script>