
    <?php foreach ($data as $row) : ?>
    <p>Nama: <?= $row['nama']; ?> - Role: <?= $row['role']; ?></p>
    
<?php endforeach; ?>


            <div class="p-6 md:p-8 space-y-8 max-w-[1600px] w-full mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-white tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400">Dashboard</h1>
                        <p class="text-sm text-slate-400 mt-1">Selamat datang kembali, yuk cek progres belajarmu hari ini.</p>
                    </div>
                    <div class="text-xs font-semibold px-4 py-2 bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 rounded-xl backdrop-blur-md self-start md:self-auto shadow-[0_0_15px_rgba(99,102,241,0.05)]">
                        Semester Genap • 2026
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-cyan-500/40 transition-all duration-300">
                        <div class="h-1 bg-gradient-to-r from-cyan-500 to-indigo-500"></div>
                        <div class="p-6 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Materi</p>
                                <div class="flex items-baseline gap-2 mt-3">
                                    <span class="text-3xl font-extrabold text-white">10</span>
                                    <span class="text-slate-600 font-light text-xl">/</span>
                                    <span class="text-xl font-bold text-slate-500">20</span>
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
                                    <span class="text-3xl font-extrabold text-amber-400">3</span>
                                    <span class="text-slate-600 font-light text-xl">/</span>
                                    <span class="text-xl font-bold text-slate-500">20</span>
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-800/50 pb-3">
                            <h2 class="font-bold text-white text-base flex items-center gap-2">
                                <i data-lucide="calendar-check" class="w-5 h-5 text-cyan-400"></i> Materi Hari Ini
                            </h2>
                            <span class="text-[11px] font-bold px-2.5 py-1 bg-cyan-500/10 text-cyan-400 rounded-full border border-cyan-500/25">3 Kelas</span>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="p-4 bg-[#101626]/60 rounded-xl border border-slate-800/80 hover:border-cyan-500/30 hover:bg-[#141b2f]/80 transition duration-300 group">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-white text-sm group-hover:text-cyan-400 transition-colors">Matematika</h3>
                                        <p class="text-xs text-slate-400 mt-1">Judul: <span class="text-slate-300 font-medium">Operasi Bilangan Bulat</span></p>
                                        <div class="flex items-center gap-1.5 mt-2 text-[11px] text-slate-500">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-cyan-500/70"></i>
                                            <span>07.30 - 08.30</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="w-full mt-4 bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-600 hover:to-indigo-700 text-slate-950 font-extrabold text-xs py-2.5 rounded-lg transition-all shadow-[0_4px_15px_rgba(6,182,212,0.25)] tracking-wider">
                                    LIHAT MATERI
                                </button>
                            </div>

                            <div class="p-4 bg-[#101626]/60 rounded-xl border border-slate-800/80 hover:border-cyan-500/30 hover:bg-[#141b2f]/80 transition duration-300 group">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-white text-sm group-hover:text-cyan-400 transition-colors">Bahasa Indonesia</h3>
                                        <p class="text-xs text-slate-400 mt-1">Judul: <span class="text-slate-300 font-medium">Teks Eksposisi Dasar</span></p>
                                        <div class="flex items-center gap-1.5 mt-2 text-[11px] text-slate-500">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-cyan-500/70"></i>
                                            <span>08.45 - 09.45</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="w-full mt-4 bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-600 hover:to-indigo-700 text-slate-950 font-extrabold text-xs py-2.5 rounded-lg transition-all shadow-[0_4px_15px_rgba(6,182,212,0.25)] tracking-wider">
                                    LIHAT MATERI
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-800/50 pb-3">
                            <h2 class="font-bold text-white text-base flex items-center gap-2">
                                <i data-lucide="clock" class="w-5 h-5 text-indigo-400"></i> Jadwal Mingguan
                            </h2>
                        </div>

                        <div class="space-y-3 overflow-y-auto max-h-[380px] pr-1">
                            <div class="bg-[#101626]/40 p-3.5 rounded-xl border border-slate-800/50">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="w-1.5 h-3 bg-cyan-400 rounded-full"></span>
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-cyan-400">Senin</h3>
                                </div>
                                <div class="space-y-2 text-xs border-l border-slate-800 pl-2.5 ml-0.5">
                                    <div class="flex justify-between"><span class="text-slate-200 font-medium">Matematika</span><span class="text-slate-500">07.30 - 08.30</span></div>
                                    <div class="flex justify-between"><span class="text-slate-200 font-medium">Bahasa Indonesia</span><span class="text-slate-500">08.45 - 09.45</span></div>
                                    <div class="flex justify-between"><span class="text-slate-200 font-medium">Seni Budaya</span><span class="text-slate-500">10.00 - 11.30</span></div>
                                </div>
                            </div>
                            
                            <div class="bg-[#101626]/40 p-3.5 rounded-xl border border-slate-800/50">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="w-1.5 h-3 bg-indigo-400 rounded-full"></span>
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-400">Selasa</h3>
                                </div>
                                <div class="space-y-2 text-xs border-l border-slate-800 pl-2.5 ml-0.5">
                                    <div class="flex justify-between"><span class="text-slate-200 font-medium">Fisika</span><span class="text-slate-500">07.30 - 08.30</span></div>
                                    <div class="flex justify-between"><span class="text-slate-200 font-medium">Kimia</span><span class="text-slate-500">08.45 - 09.45</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900/40 p-6 rounded-2xl border border-slate-800/80 backdrop-blur-md shadow-lg flex flex-col items-center justify-center relative min-h-[340px]">
                        
                        <button class="absolute top-4 right-4 text-[10px] font-bold uppercase tracking-wider border border-slate-800 bg-[#070a12]/80 px-2.5 py-1 rounded-lg text-slate-400 hover:text-white hover:border-slate-700 transition flex items-center gap-1">
                            Filter <i data-lucide="chevron-down" class="w-3 h-3"></i>
                        </button>
                        
                        <div class="relative w-44 h-44 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90 drop-shadow-[0_0_15px_rgba(99,102,241,0.4)]" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="40" stroke="#121826" stroke-width="6" fill="transparent" />
                                <circle cx="50" cy="50" r="40" stroke="url(#auroraGradient)" stroke-width="6" fill="transparent" stroke-dasharray="251.2" stroke-dashoffset="62.8" stroke-linecap="round" />
                                
                                <defs>
                                    <linearGradient id="auroraGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#06b6d4" />
                                        <stop offset="100%" stop-color="#6366f1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            
                            <div class="absolute w-32 h-32 rounded-full overflow-hidden border-2 border-slate-800 shadow-2xl">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=300&auto=format&fit=crop" alt="User Avatar" class="w-full h-full object-cover brightness-95 contrast-110">
                            </div>
                        </div>
                        
                        <div class="text-center mt-5">
                            <h3 class="font-extrabold text-white text-lg tracking-wide">Alex Joshua</h3>
                            <p class="text-xs text-indigo-400 font-semibold flex items-center justify-center gap-1.5 mt-1">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full shadow-[0_0_8px_#34d399]"></span> 
                                Progress Belajar: 75%
                            </p>
                        </div>
                    </div>

                </div>

            </div>
