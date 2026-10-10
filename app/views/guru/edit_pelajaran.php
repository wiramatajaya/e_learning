<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelajaran - E-Learning</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#0b0f19] font-sans text-slate-200 antialiased bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-[#1e1b4b]/40 via-[#0f172a] to-[#070a13] min-h-screen flex items-center justify-center p-4 md:p-8">
    <!-- CONTAINER FORM (Glassmorphism Card) -->
    <div class="w-full max-w-2xl bg-slate-900/40 rounded-2xl border border-slate-800/80 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.4)] overflow-hidden">
        
        <!-- Header Form dengan Aksen Gradasi Neon -->
        <div class="h-1 bg-gradient-to-r from-cyan-500 via-indigo-500 to-purple-500"></div>
        <div class="p-6 border-b border-slate-800/60 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-tr from-indigo-500 to-cyan-400 text-slate-950 p-2.5 rounded-xl shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-white tracking-wide">Edit Pelajaran</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui informasi mata pelajaran dan berkas terkait</p>
                </div>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 bg-slate-800/80 text-slate-400 border border-slate-700/60 rounded-lg">
                ID: #1
            </span>
        </div>

        <!-- Form Fields -->
        <form class="p-6 space-y-6">
            
            <!-- 1. INPUT NAMA MAPEL -->
            <div class="space-y-2">
                <label for="nama_mapel" class="text-xs font-bold uppercase tracking-wider text-cyan-400 flex items-center gap-1.5">
                    <i data-lucide="book-open" class="w-4 h-4 text-cyan-500/80"></i> Nama Mata Pelajaran
                </label>
                <div class="relative">
                    <input type="text" id="nama_mapel" value="Matematika" 
                        class="w-full bg-[#101626]/60 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/50 focus:shadow-[0_0_15px_rgba(6,182,212,0.15)] transition duration-200"
                        placeholder="Masukkan nama mata pelajaran...">
                </div>
            </div>

            <!-- 2. UPLOAD FILE (Drag & Drop Zone Modern) -->
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-wider text-indigo-400 flex items-center gap-1.5">
                    <i data-lucide="file-up" class="w-4 h-4 text-indigo-500/80"></i> Unggah Modul / Cover Materi
                </label>
                
                <div class="border-2 border-dashed border-slate-800 hover:border-indigo-500/50 bg-[#101626]/30 hover:bg-[#101626]/60 rounded-xl p-6 text-center cursor-pointer transition duration-300 group relative">
                    <input type="file" id="file_upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    
                    <div class="space-y-2">
                        <div class="mx-auto w-10 h-10 bg-indigo-500/10 text-indigo-400 rounded-xl flex items-center justify-center border border-indigo-500/20 group-hover:scale-110 transition-transform duration-300 shadow-[0_0_15px_rgba(99,102,241,0.1)]">
                            <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                        </div>
                        <div class="text-xs text-slate-300">
                            <span class="font-bold text-indigo-400 group-hover:underline">Klik untuk unggah</span> atau seret file ke sini
                        </div>
                        <p class="text-[10px] text-slate-500">PDF, PPT, DOCX, atau Gambar (Maks. 10MB)</p>
                    </div>
                </div>

                <!-- Preview File Terunggah Sebelumnya (Opsional/Kondisional) -->
                <div class="flex items-center justify-between p-3 bg-[#101626]/80 border border-slate-800/80 rounded-xl text-xs">
                    <div class="flex items-center gap-2.5 text-slate-300 truncate">
                        <i data-lucide="file-text" class="w-4 h-4 text-cyan-400 flex-shrink-0"></i>
                        <span class="truncate font-medium">Modul_Matematika_Kelas_6.pdf</span>
                        <span class="text-[10px] text-slate-500">(2.4 MB)</span>
                    </div>
                    <button type="button" class="text-slate-500 hover:text-rose-400 p-1 rounded-lg hover:bg-rose-500/10 transition">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- 3. INPUT DESKRIPSI -->
            <div class="space-y-2">
                <label for="deskripsi" class="text-xs font-bold uppercase tracking-wider text-purple-400 flex items-center gap-1.5">
                    <i data-lucide="align-left" class="w-4 h-4 text-purple-500/80"></i> Deskripsi Pelajaran
                </label>
                <textarea id="deskripsi" rows="4"
                    class="w-full bg-[#101626]/60 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/50 focus:shadow-[0_0_15px_rgba(168,85,247,0.15)] transition duration-200 resize-none"
                    placeholder="Mata pelajaran yang mengasah logika lewat materi pecahan, lingkaran, bangun ruang..."></textarea>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800/60">
                <button type="button" 
                    class="px-5 py-2.5 rounded-xl border border-slate-800 bg-slate-950/40 text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-white hover:bg-slate-900/60 hover:border-slate-700 transition">
                    Batal
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-600 hover:to-indigo-700 text-slate-950 font-extrabold text-xs uppercase tracking-widest transition-all shadow-[0_4px_20px_rgba(6,182,212,0.25)] flex items-center gap-1.5">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>

    <!-- Init Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>