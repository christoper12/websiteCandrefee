// Dark mode toggle
function toggleDarkMode() {
    const body = document.body;
    const cardList = document.querySelectorAll('.card');
    const cardList2 = document.querySelectorAll('.light');
    const btn = document.getElementById('darkModeBtn');

    body.classList.toggle('bg-dark');
    body.classList.toggle('text-light');

    document.body.classList.toggle('midnight-bg');
    document.body.classList.toggle('midnight-text');
    cardList.forEach(c => c.classList.toggle('midnight-card'));
    cardList2.forEach(c => c.classList.toggle('midnight-card'));

    const isDark = body.classList.contains('bg-dark');

    // Update button text + style
    if (isDark) {
        btn.innerHTML = '<i class="bi bi-sun-fill"></i> Light Mode';
        btn.classList.remove('btn-outline-dark');
        btn.classList.add('btn-outline-secondary', 'text-dark');
    } else {
        btn.innerHTML = '<i class="bi bi-moon-fill"></i> Dark Mode';
        btn.classList.remove('btn-light', 'text-dark');
        btn.classList.add('btn-outline-dark');
    }
}
