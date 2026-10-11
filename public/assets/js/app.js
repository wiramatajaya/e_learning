/**
 * EduLearn Main JavaScript
 */

// Mobile Sidebar Toggle
function toggleSidebar() {
    const sidebar = document.getElementById('main-sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    if (!sidebar) return;

    if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
    } else {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    }
}

// Modal Management
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        if (window.lucide) {
            lucide.createIcons();
        }
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}

// Global Delete Confirmation Modal
function triggerDelete(actionUrl, title = 'Konfirmasi Hapus Data', message = 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.') {
    const modal = document.getElementById('confirmModal');
    const form = document.getElementById('confirmModalForm');
    const titleEl = document.getElementById('confirmModalTitle');
    const messageEl = document.getElementById('confirmModalMessage');

    if (form && modal) {
        form.action = actionUrl;
        if (titleEl) titleEl.innerText = title;
        if (messageEl) messageEl.innerText = message;
        openModal('confirmModal');
    }
}

function closeConfirmModal() {
    closeModal('confirmModal');
}

// Generic Table Live Filter
function filterTable(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    if (!input || !table) return;

    const filter = input.value.toLowerCase();
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const text = rows[i].textContent || rows[i].innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// Close modals when clicking backdrop or pressing Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const openModals = document.querySelectorAll('[id$="Modal"]:not(.hidden)');
        openModals.forEach(m => closeModal(m.id));
    }
});
