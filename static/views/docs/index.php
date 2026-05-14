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
                <h1>Lima Documentation</h1>
                <p>Welcome to the Lima docs. This area covers the core pieces of the framework, from installing a new project through to routing, controllers, templates, models, validation, and extending the framework for your own applications.</p>
                <p>If you're new to Lima, start with <a href="/docs/getting-started">Getting Started</a>, then move on to <a href="/docs/routing">Routing</a> and <a href="/docs/controllers-and-views">Controllers and Views</a>. Those pages explain the request flow and the structure you'll use in most projects.</p>
                <p>Once you're comfortable with the basics, the <a href="/docs/models-and-database">Models and Database</a>, <a href="/docs/validation">Validation</a>, and <a href="/docs/extending-lima">Extending Lima</a> pages go deeper into the parts you're most likely to customise as your project grows.</p>

                <h3>Recommended reading order</h3>
                <ul>
                    <li><a href="/docs/about">About</a> - learn what Lima is and why it exists.</li>
                    <li><a href="/docs/getting-started">Getting Started</a> - install Lima and set up the project structure.</li>
                    <li><a href="/docs/configuration">Configuration</a> - understand the environment variables Lima uses.</li>
                    <li><a href="/docs/routing">Routing</a> - map URLs to controllers and methods.</li>
                    <li><a href="/docs/controllers-and-views">Controllers and Views</a> - render PHP or Twig templates from your controllers.</li>
                    <li><a href="/docs/models-and-database">Models and Database</a> - work with MySQL, models, collections, and items.</li>
                    <li><a href="/docs/validation">Validation</a> - validate and sanitize request input.</li>
                    <li><a href="/docs/extending-lima">Extending Lima</a> - add your own structure, helpers, and application layer.</li>
                </ul>
            </div>
        </article>
    </div>
</section>

<?php $view->get_footer(); ?>
