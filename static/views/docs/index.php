<?php $view->get_header(); ?>

<section class="docs-hero">
    <div class="container">
        <div class="section-heading docs-heading">
            <p class="eyebrow">Lima documentation</p>
            <h1>The Docs</h1>
            <p>Learn all you need to know about Lima MVC.</p>
        </div>
    </div>
</section>

<section class="docs-layout-section">
    <div class="container docs-layout">
        <?php $view->render('docs/_templates/sidebar'); ?>

        <article class="docs-content">
            <div class="docs-prose">
                <p>Content here</p>
            </div>
        </article>
    </div>
</section>

<?php $view->get_footer(); ?>
