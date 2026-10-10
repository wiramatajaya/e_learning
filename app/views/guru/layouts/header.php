<?php

$list_menu=[
    ["title"=>"Dashboard","icon"=>"home","link"=>"index.php?url=guru/dashboard"],
    ["title"=>"Materi","icon"=>"layout-dashboard","link"=>"index.php?url=guru/pelajaran"],
    ["title"=>"Quiz","icon"=>"book-open","link"=>"index.php?url=guru/quiz"],
]
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Dashboard - Modern Neon Dark</title>
       <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

 
</head>
<body class="bg-[#0b0f19] font-sans text-slate-200 antialiased bg-[radial-gradient(circle_at_top_left,_var(--tw-gradient-stops))] from-[#1e1b4b]/40 via-[#0f172a] to-[#070a13]">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#090d16]/90 border-r border-slate-800/60 text-slate-400 flex flex-col justify-between hidden md:flex backdrop-blur-xl">
            <div>
                <div class="p-6 flex items-center gap-3 border-b border-slate-800/50">
                    <div class="bg-gradient-to-tr from-indigo-500 to-cyan-400 text-slate-950 p-2 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)]">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-extrabold text-white tracking-wide bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400">E-Learning</span>
                </div>
                    <nav class="p-4 space-y-1.5">
                        <?php 
                        $current_url = $_GET["url"] ?? 'guru/dashboard';
                        foreach($list_menu as $m) :
                            $menu_url = str_replace('index.php?url=', '', $m['link']);
                            if ($menu_url === $current_url) { ?>
                        <a href="<?= $m["link"] ?>" class="flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-indigo-600/30 via-cyan-500/10 to-transparent text-cyan-400 rounded-xl font-semibold border-l-4 border-cyan-400 shadow-[inset_4px_0_15px_rgba(6,182,212,0.15)] transition-all">
                            <i data-lucide="<?= $m['icon'] ?>" class="w-5 h-5"></i> <?= $m["title"] ?>
                        </a>
                        <?php } else { ?>
                                <a href="<?= $m["link"] ?>" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800/40 hover:text-white rounded-xl font-medium transition-all group">
                                    <i data-lucide="<?= $m['icon'] ?>" class="w-5 h-5 text-slate-500 group-hover:text-indigo-400"></i> <?= $m["title"] ?>
                                </a>
                        <?php } endforeach;  ?>
                        <a href="index.php?url=auth/logout" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800/40 hover:text-white rounded-xl font-medium transition-all group">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-slate-500 group-hover:text-indigo-400"></i> logout
                    </a>
                    </nav>

            </div>
            
            <div class="p-4 border-t border-slate-800/60 flex items-center gap-3 bg-[#070a12]/60">
                <div class="relative">
                    <img src="asdp" alt="Avatar" class="w-10 h-10 rounded-full object-cover ring-2 ring-indigo-500/50">
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-400 rounded-full ring-2 ring-[#070a12]"></span>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white">Alex Joshua</h4>
                    <p class="text-xs text-slate-500">Siswa</p>
                </div>
            </div>
        </aside>

        
        <main class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-[#0b0f19]/40 border-b border-slate-800/40 h-16 flex items-center justify-between px-6 md:px-8 shrink-0 backdrop-blur-xl z-10">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 tracking-wide uppercase">
                    <span>Home</span> <span class="text-slate-700">/</span>
                    <span>Pages</span> <span class="text-slate-700">/</span>
                    <span class="text-cyan-400 normal-case font-semibold">Dashboard</span>
                </div>
                <div class="flex items-center gap-3 text-slate-400">
                    <button class="p-2 hover:bg-slate-800/60 hover:text-white rounded-xl transition"><i data-lucide="search" class="w-5 h-5"></i></button>
                    <button class="p-2 hover:bg-slate-800/60 hover:text-white rounded-xl transition relative">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-pink-500 rounded-full shadow-[0_0_10px_#ec4899]"></span>
                    </button>
                    <button class="p-2 hover:bg-slate-800/60 hover:text-white rounded-xl transition"><i data-lucide="settings" class="w-5 h-5"></i></button>
                </div>
            </header>
