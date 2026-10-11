        </main>

        <!-- Footer -->
        <footer class="h-14 bg-white border-t border-slate-200/80 px-4 sm:px-8 flex items-center justify-between text-xs text-slate-500">
            <p>&copy; <?= date('Y') ?> <span class="font-semibold text-slate-700"><?= APP_NAME ?></span> - <?= APP_DESC ?></p>
            <p class="hidden sm:block">Versi <?= APP_VERSION ?> &bull; PHP OOP MVC & Tailwind CSS</p>
        </footer>
    </div>
</div>

<!-- Global Generic Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all animate-scale-up">
        <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 mb-4">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
        </div>
        <h3 id="confirmModalTitle" class="text-lg font-bold text-slate-900 mb-2">Konfirmasi Tindakan</h3>
        <p id="confirmModalMessage" class="text-sm text-slate-600 mb-6">Apakah Anda yakin ingin melanjutkan tindakan ini? Data yang dihapus tidak dapat dipulihkan.</p>
        <div class="flex items-center justify-end space-x-3">
            <button type="button" onclick="closeConfirmModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <form id="confirmModalForm" method="POST" action="">
                <?= csrf_field() ?>
                <button type="submit" id="confirmModalSubmitBtn" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-sm font-semibold text-white shadow-md shadow-rose-600/20 transition-all">
                    Ya, Lanjutkan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Main Application JS -->
<script src="<?= url('assets/js/app.js') ?>"></script>
<script>
    // Initialize icons
    lucide.createIcons();
</script>
</body>
</html>
