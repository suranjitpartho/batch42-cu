document.addEventListener('DOMContentLoaded', () => {
    const navGroupHeaders = document.querySelectorAll('.nav-group-header');

    navGroupHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const navGroup = header.closest('.nav-group');
            const navGroupLinks = navGroup.querySelector('.nav-group-links');
            const navGroupIcon = navGroup.querySelector('.nav-group-icon');

            const isOpen = navGroupLinks.classList.contains('is-open');

            if (isOpen) {
                // Collapse
                navGroupLinks.style.maxHeight = navGroupLinks.scrollHeight + 'px'; // Set explicit height before transition
                requestAnimationFrame(() => {
                    navGroupLinks.style.maxHeight = '0';
                    navGroupLinks.classList.remove('is-open');
                    navGroupIcon.classList.remove('rotate-90');
                });
            } else {
                // Expand
                navGroupLinks.classList.add('is-open');
                navGroupLinks.style.maxHeight = navGroupLinks.scrollHeight + 'px';
                navGroupIcon.classList.add('rotate-90');

                // After transition, remove explicit maxHeight to allow content changes
                navGroupLinks.addEventListener('transitionend', function handler() {
                    navGroupLinks.style.maxHeight = '';
                    navGroupLinks.removeEventListener('transitionend', handler);
                });
            }
        });

        // Set initial state based on 'nav-group-active' class
        const navGroup = header.closest('.nav-group');
        const navGroupLinks = navGroup.querySelector('.nav-group-links');
        const navGroupIcon = navGroup.querySelector('.nav-group-icon');

        if (navGroup.classList.contains('nav-group-active')) {
            navGroupLinks.classList.add('is-open');
            navGroupLinks.style.maxHeight = ''; // Allow content to determine height
            navGroupIcon.classList.add('rotate-90');
        } else {
            navGroupLinks.style.maxHeight = '0';
        }
    });
});
