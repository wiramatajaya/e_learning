<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="h-full flex items-center justify-center p-6 font-sans">
    <div class="max-w-md w-full text-center">
        <div class="w-20 h-20 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-6 shadow-sm border border-indigo-100">
            <i data-lucide="compass" class="w-10 h-10"></i>
        </div>
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">404</h1>
        <h2 class="text-xl font-bold text-slate-800 mb-2">Halaman Tidak Ditemukan</h2>
        <p class="text-sm text-slate-500 mb-8">
            <?= htmlspecialchars($message ?? 'Halaman yang Anda tuju mungkin telah dipindahkan atau tautan tidak valid.') ?>
        </p>
        <a href="<?= url() ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-600/20 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
