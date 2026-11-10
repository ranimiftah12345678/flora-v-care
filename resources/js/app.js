

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Theme toggle handler (Dark / Light mode)
function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

window.toggleTheme = function () {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark } }));
};

// Event delegation: satu listener untuk semua tombol toggle tema,
// termasuk tombol yang dirender ulang oleh Alpine/navigasi.
document.addEventListener('click', (event) => {
    const toggleBtn = event.target.closest('[data-theme-toggle], .theme-toggle-btn');
    if (toggleBtn) {
        event.preventDefault();
        window.toggleTheme();
    }
});

// Listen for system theme changes if user has not set a preference
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        if (e.matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});

initTheme();
document.addEventListener('DOMContentLoaded', initTheme);

Alpine.start();

