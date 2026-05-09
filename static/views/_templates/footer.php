        </main>

        <footer class="site-footer">
            <div class="container footer-layout">
                <div>
                    <a class="brand brand-footer" href="/">
                        <img src="/assets/images/logo-mark.svg" width="36" height="36" alt="">
                        <span>Lima PHP</span>
                    </a>
                    <p>Website proudly powered by Lima MVC, the developer focused friendly framework.</p>
                </div>
                <div class="footer-links">
                    <a href="<?php echo e($docsUrl ?? 'https://docs.limaphp.com'); ?>" target="_blank" rel="noopener noreferrer">Documentation</a>
                    <a href="#why-lima">Why Lima</a>
                    <a href="#faq">FAQ</a>
                    <a href="https://github.com/TechyThomas/lima-mvc" target="_blank">GitHub</a>
                </div>
            </div>
        </footer>
    </div>
    <script>
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
    </script>
</body>
</html>
