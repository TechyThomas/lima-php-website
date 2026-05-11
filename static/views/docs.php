<?php $view->get_header(); ?>

<section class="docs-hero">
    <div class="container">
        <div class="section-heading docs-heading">
            <p class="eyebrow">Lima documentation</p>
            <h1>Title Here</h1>
            <p>Edit the markdown files in <code>static/docs</code> and this docs area will pick them up automatically. Add a new file and it becomes a new section in the sidebar.</p>
        </div>
    </div>
</section>

<section class="docs-layout-section">
    <div class="container docs-layout">
        <aside class="docs-sidebar-wrap">
            <div class="docs-sidebar">
                <p class="docs-sidebar-label"><?php echo lucide_icon('file-text'); ?><span>Documentation</span></p>
                <nav aria-label="Documentation pages">
                    <a class="docs-nav-link" href="#">
                        <span>Title</span>
                        <?php echo lucide_icon('chevron-right'); ?>
                    </a>
                </nav>
                <a class="docs-home-link" href="/">
                    <?php echo lucide_icon('house'); ?>
                    <span>Back to homepage</span>
                </a>
            </div>
        </aside>

        <article class="docs-content">
            <div class="docs-prose">
                <p>Content here</p>
            </div>
        </article>
    </div>
</section>

<?php $view->get_footer(); ?>
