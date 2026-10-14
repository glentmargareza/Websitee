/**
 * app.js — Jeep Wukirsari
 * JavaScript utama aplikasi
 */

document.addEventListener('DOMContentLoaded', function () {

    // =========================================================
    // NAVBAR — Scroll behavior & mobile toggle
    // =========================================================
    const navbar   = document.getElementById('navbar');
    const toggle   = document.getElementById('navbar-toggle');
    const menu     = document.getElementById('navbar-menu');

    // Tambahkan class 'scrolled' saat halaman discroll
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Toggle menu mobile
    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            const isOpen = menu.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen);
        });

        // Tutup menu saat link diklik
        menu.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('open');
                toggle.setAttribute('aria-expanded', false);
            });
        });
    }

    // =========================================================
    // SMOOTH SCROLL — Untuk anchor link internal
    // =========================================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId  = this.getAttribute('href');
            const target    = document.querySelector(targetId);

            if (target) {
                e.preventDefault();
                const navbarH = navbar ? navbar.offsetHeight : 0;
                const top     = target.getBoundingClientRect().top + window.scrollY - navbarH - 16;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // =========================================================
    // FEATURE CARDS — Animasi masuk saat scroll (Intersection Observer)
    // =========================================================
    const featureCards = document.querySelectorAll('.feature-card');

    if ('IntersectionObserver' in window && featureCards.length > 0) {
        // Set initial invisible state
        featureCards.forEach(function (card) {
            card.style.opacity  = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity  = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        featureCards.forEach(function (card) {
            observer.observe(card);
        });
    }

    console.log('%c🚙 Jeep Wukirsari — App loaded', 'color: #D4570A; font-weight: bold; font-size: 14px;');
});
