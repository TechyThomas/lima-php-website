<?php $view->get_header(); ?>

<section class="docs-hero">
    <div class="container">
        <div class="section-heading docs-heading">
            <p class="eyebrow">404 error</p>
            <h1>The page you were looking for has drifted out of route.</h1>
            <p>The URL might be outdated, mistyped, or no longer available. Head back to the homepage or jump into the
                docs to keep exploring Lima.</p>
        </div>

        <div class="cta-panel">
            <div class="cta-content">
                <p class="eyebrow">Quick recovery</p>
                <h2>Pick a safer path.</h2>
                <p>Everything else on the site is still intact, so you can get back on track in one click.</p>
            </div>
            <div class="hero-actions">
                <a class="button button-primary button-block" href="/">
                    <?php echo lucide_icon('house'); ?>
                    <span>Go home</span>
                </a>
                <a class="button button-ghost button-block" href="/docs">
                    <?php echo lucide_icon('arrow-left'); ?>
                    <span>Browse docs</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php $view->get_footer(); ?>