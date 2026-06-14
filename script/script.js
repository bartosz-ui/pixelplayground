document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('open-login');
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-login');

    function openModal() {
        if (!modal) return;
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
    }

    openBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        openModal();
    });

    closeBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        closeModal();
    });


    modal?.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });


    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
});
