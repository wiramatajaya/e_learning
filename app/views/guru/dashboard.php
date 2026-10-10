<?php $hari=['Minggu','Senin','selasa','Rabu','Kamis','Jumaat','Sabtu']?>
<div class="p-6 md:p-8 space-y-8 max-w-[1600px] w-full mx-auto">

    <!-- CARD HEADER -->
    <!-- CARD HEADER -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-cyan-500/40 transition-all duration-300">
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-indigo-500"></div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Materi</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-white"><?= $data["head_cards"]['total_ujian']['selesai']; ?></span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500"><?= $data["head_cards"]['total_ujian']['total_semua']; ?></span>
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
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest">Tugas</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-amber-400"><?= $data["head_cards"]['total_materi']['selesai']; ?></span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500"><?= $data["head_cards"]['total_materi']['total_semua']; ?></span>
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
                    <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Pertemuan</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <span class="text-3xl font-extrabold text-white">10</span>
                        <span class="text-slate-600 font-light text-xl">/</span>
                        <span class="text-xl font-bold text-slate-500">120</span>
                    </div>
                    <span class="text-[10px] font-medium text-slate-400 block mt-1.5 bg-indigo-500/10 text-indigo-300 px-2 py-0.5 rounded-md w-max">Total Tatap Muka</span>
                </div>
                <div class="bg-indigo-500/10 text-indigo-400 p-3.5 rounded-xl border border-indigo-500/20 shadow-[0_0_20px_rgba(99,102,241,0.15)]"><i data-lucide="video" class="w-6 h-6"></i></div>
            </div>
        </div>

    </div>
    
    <!-- CARD JADWA HARI INI -->
    <!-- CARD JADWA HARI INI -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/50 pb-3">
                <h2 class="font-bold text-white text-base flex items-center gap-2">
                    <i data-lucide="calendar-check" class="w-5 h-5 text-cyan-400"></i> Materi Hari Ini
                </h2>
                <span class="text-[11px] font-bold px-2.5 py-1 bg-cyan-500/10 text-cyan-400 rounded-full border border-cyan-500/25">3 Kelas</span>
            </div>
            
            <div class="space-y-3">
            <?php foreach($data["jadwal_harian"] as $j ):?>
                <div class="p-4 bg-[#101626]/60 rounded-xl border border-slate-800/80 hover:border-cyan-500/30 hover:bg-[#141b2f]/80 transition duration-300 group">
                    <div class=" w-full items-start">
                        <div class="flex justify-between w-full">
                            <div class="font-bold text-white text-sm group-hover:text-cyan-400 transition-colors"><?= $j["mata_pelajaran"] ?></div>
                            <p class="text-xs text-slate-400 mt-1">Judul:Operasi Bilangan Bulat</p>
                        </div>
                        <div class="flex items-center gap-1.5 mt-2 text-[11px] text-slate-500">
                            <i data-lucide="clock" class="w-3.5 h-3.5 text-cyan-500/70"></i>
                            <span><?= $j["jam_mulai"] ?> - <?= $j["jam_selesai"] ?></span>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-600 hover:to-indigo-700 text-slate-950 font-extrabold text-xs py-2.5 rounded-lg transition-all shadow-[0_4px_15px_rgba(6,182,212,0.25)] tracking-wider">
                        LIHAT MATERI
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
                <!-- JADWAL -->
                <!-- JADWAL -->
        <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/50 pb-3">
                <h2 class="font-bold text-white text-base flex items-center gap-2">
                    <i data-lucide="clock" class="w-5 h-5 text-indigo-400"></i> Jadwal Mingguan
                </h2>
            </div>
            <div class="space-y-3 overflow-y-auto max-h-[500px] pr-1">
                <?php foreach ($data["jadwal"] as $id_hari => $list_pelajaran): ?>
                <div class="bg-[#101626]/40 p-3.5 rounded-xl border border-slate-800/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-3 bg-cyan-400 rounded-full"></span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-cyan-400"><?=  $hari[$id_hari]  ?></h3>
                    </div>
                    <div class="space-y-2 text-xs border-l border-slate-800 pl-2.5 ml-0.5">
                        <?php foreach ($list_pelajaran as $j): ?>
                        <div class="flex justify-between">
                            <span class="text-slate-200 font-medium"><?= $j["mata_pelajaran"] ?></span>
                            <span class="text-slate-500"><?= "".$j["jam_mulai"]."-".$j["jam_selesai"]?></span></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- SISWA -->
        <!-- SISWA -->
        <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/50 pb-3">
                <h2 class="font-bold text-white text-base flex items-center gap-2">
                    <i data-lucide="clock" class="w-5 h-5 text-indigo-400"></i> Jadwal Mingguan
                </h2>
            </div>
            <div class="space-y-3 overflow-y-auto max-h-[500px] pr-1">
                <?php foreach ($data["jadwal"] as $id_hari => $list_pelajaran): ?>
                <div class="bg-[#101626]/40 p-3.5 rounded-xl border border-slate-800/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-3 bg-cyan-400 rounded-full"></span>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-cyan-400"><?=  $hari[$id_hari]  ?></h3>
                    </div>
                    <div class="space-y-2 text-xs border-l border-slate-800 pl-2.5 ml-0.5">
                        <?php foreach ($list_pelajaran as $j): ?>
                        <div class="flex justify-between">
                            <span class="text-slate-200 font-medium"><?= $j["mata_pelajaran"] ?></span>
                            <span class="text-slate-500"><?= "".$j["jam_mulai"]."-".$j["jam_selesai"]?></span></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        

    </div>

</div>
