// Animation au scroll
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('[data-scroll-animation]');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const animationName = entry.target.getAttribute('data-scroll-animation');
                const animationDelay = entry.target.getAttribute('data-animation-delay') || '0s';

                entry.target.style.animationName = animationName;
                entry.target.style.animationDelay = animationDelay;
                entry.target.style.opacity = 1;

                observer.unobserve(entry.target); // Pour éviter que l'animation se répète
            }
        });
    });

    animatedElements.forEach(el => {
        observer.observe(el);
    });
});

// Gestion du menu burger et de la sidebar
document.addEventListener('DOMContentLoaded', function() {
    const menuBurger = document.getElementById('menu-burger');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.querySelector('.close-btn');

    menuBurger.addEventListener('click', function() {
        sidebar.classList.add('active'); // Utiliser la classe 'active' définie dans le CSS
        menuBurger.setAttribute('aria-expanded', 'true'); // Indique que le menu est ouvert
    });

    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('active'); // Utiliser la classe 'active' définie dans le CSS
        menuBurger.setAttribute('aria-expanded', 'false'); // Indique que le menu est fermé
    });

    // Fermer la sidebar si l'utilisateur clique en dehors de celle-ci
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !menuBurger.contains(event.target)) {
            sidebar.classList.remove('active'); // Utiliser la classe 'active' définie dans le CSS
            menuBurger.setAttribute('aria-expanded', 'false'); // Indique que le menu est fermé
        }
    });
});