document.querySelectorAll('.site-menu').forEach((menu) => {
    const toggle = menu.querySelector('.menu-toggle');
    const closeButton = menu.querySelector('.menu-close');
    const backdrop = menu.querySelector('.menu-backdrop');
    const flyout = menu.querySelector('.mobile-flyout');
    const links = menu.querySelectorAll('.nav-links-mobile a');
    const body = document.body;

    const syncExpandedState = () => {
        if (toggle) {
            toggle.setAttribute('aria-expanded', menu.classList.contains('is-open') ? 'true' : 'false');
        }
    };

    const openMenu = () => {
        menu.classList.add('is-open');
        body.classList.add('menu-open');
        syncExpandedState();
    };

    const closeMenu = () => {
        menu.classList.remove('is-open');
        body.classList.remove('menu-open');
        syncExpandedState();
    };

    syncExpandedState();

    toggle?.addEventListener('click', () => {
        if (menu.classList.contains('is-open')) {
            closeMenu();
            return;
        }

        openMenu();
    });

    closeButton?.addEventListener('click', closeMenu);
    backdrop?.addEventListener('click', closeMenu);

    links.forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('click', (event) => {
        if (!menu.classList.contains('is-open')) {
            return;
        }

        const target = event.target;

        if (!(target instanceof Node)) {
            return;
        }

        if (toggle?.contains(target) || flyout?.contains(target)) {
            return;
        }

        closeMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menu.classList.contains('is-open')) {
            closeMenu();
        }
    });
});

const getAnchorTarget = (hash) => {
    if (!hash || hash === '#') {
        return null;
    }

    const id = decodeURIComponent(hash.slice(1));

    return document.getElementById(id);
};

const scrollToAnchor = (target, behavior = 'smooth') => {
    const header = document.querySelector('.site-header');
    const headerHeight = header ? header.getBoundingClientRect().height : 0;
    const breathingRoom = 24;
    const targetTop = target.getBoundingClientRect().top + window.scrollY;
    const scrollTop = Math.max(targetTop - headerHeight - breathingRoom, 0);

    window.scrollTo({
        top: scrollTop,
        behavior,
    });
};

document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
        const target = getAnchorTarget(link.hash);

        if (!target) {
            return;
        }

        event.preventDefault();
        history.pushState(null, '', link.hash);
        scrollToAnchor(target);
    });
});

window.addEventListener('load', () => {
    const target = getAnchorTarget(window.location.hash);

    if (!target) {
        return;
    }

    setTimeout(() => scrollToAnchor(target, 'auto'), 0);
});
