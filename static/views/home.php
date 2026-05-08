<?php

declare(strict_types=1);

$page = $page ?? [];
$highlights = $highlights ?? [];
$pillars = $pillars ?? [];
$workflow = $workflow ?? [];
$faqs = $faqs ?? [];
$codeSamples = $codeSamples ?? [];

if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('lucide_icon')) {
    function lucide_icon(string $icon, string $className = ''): string
    {
        $icons = [
            'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
            'book-open' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
            'code' => '<path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/><path d="m14.5 4-5 16"/>',
            'layers' => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5"/><path d="m3 16 9 5 9-5"/>',
            'monitor' => '<rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>',
            'package' => '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>',
            'rocket' => '<path d="M4.5 16.5c-1.5 1.5-2 4.5-2 4.5s3-.5 4.5-2c1-1 1-2.5 0-3.5s-2.5-1-3.5 0Z"/><path d="M10 14 20 4"/><path d="M9 15c-1.5-4.5 1.5-9 5-11 2.5 0 4.5 2 4.5 4.5-2 3.5-6.5 6.5-11 5Z"/><path d="M15 9h.01"/>',
            'signpost' => '<path d="M12 13v8"/><path d="M12 3v3"/><path d="M18 6H8l-2 3 2 3h10l2-3Z"/><path d="M6 12H4l-2 3 2 3h8"/>',
            'sparkles' => '<path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5Z"/><path d="M5 3v4"/><path d="M3 5h4"/><path d="M19 16v5"/><path d="M16.5 18.5h5"/>',
            'terminal' => '<path d="M4 17 10 11 4 5"/><path d="M12 19h8"/>',
        ];

        $paths = $icons[$icon] ?? $icons['code'];
        $class = $className !== '' ? ' ' . $className : '';

        return '<svg class="icon' . $class . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $paths . '</svg>';
    }
}

$title = $page['title'] ?? 'Lima PHP Framework';
$description = $page['description'] ?? 'Lima is a PHP MVC framework.';
$canonical = $page['canonical'] ?? '/';
$siteName = $page['site_name'] ?? 'Lima PHP';
$ogImage = $page['og_image'] ?? '/assets/images/og-card.svg';
$docsUrl = $page['docs_url'] ?? 'https://docs.limaphp.com';
$packageName = $page['package_name'] ?? 'spacecow/lima-mvc';
$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            'name' => $siteName,
            'url' => $canonical,
            'description' => $description,
            'inLanguage' => 'en',
        ],
        [
            '@type' => 'SoftwareApplication',
            'name' => $siteName,
            'url' => $canonical,
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Cross-platform',
            'programmingLanguage' => 'PHP',
            'description' => $description,
            'softwareHelp' => $docsUrl,
        ],
    ],
];

$view->get_header();
?>
            <section class="hero">
                <div class="container hero-layout">
                    <div class="hero-intro">
                        <p class="eyebrow">Modern PHP MVC framework</p>
                        <h1>Ship structured PHP applications without dragging developers through framework ceremony.</h1>
                    </div>
                    <div class="hero-grid">
                        <div class="hero-copy">
                        <p class="hero-text">Lima is built for developers who want a clean MVC workflow, familiar PHP patterns, and the freedom to render with PHP or Twig. It keeps the path from idea to shipped product clear, fast, and enjoyable.</p>
                        <div class="hero-actions">
                            <a class="button button-primary" href="<?php echo e($docsUrl); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo lucide_icon('book-open'); ?>
                                <span>Explore the documentation</span>
                            </a>
                        </div>
                        </div>

                        <aside class="hero-panel" id="code-sample" aria-label="Example Lima workflow">
                            <div class="panel-window">
                                <div class="panel-topbar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="terminal-block">
                                    <p class="panel-label"><?php echo lucide_icon('terminal'); ?><span>Install the Framework</span></p>
                                    <pre><code><?php echo e($codeSamples['install'] ?? 'composer require spacecow/lima-mvc'); ?></code></pre>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>

            <section class="trust-strip" aria-label="Framework summary">
                <div class="container trust-grid">
                    <article class="trust-card">
                        <div class="trust-icon"><?php echo lucide_icon('package'); ?></div>
                        <p><strong><?php echo e($packageName); ?></strong> keeps Lima composer-first and easy to integrate.</p>
                    </article>
                    <article class="trust-card">
                        <div class="trust-icon"><?php echo lucide_icon('sparkles'); ?></div>
                        <p>Use plain PHP templates for speed or switch to Twig when the project benefits from it.</p>
                    </article>
                    <article class="trust-card">
                        <div class="trust-icon"><?php echo lucide_icon('layers'); ?></div>
                        <p>Built for developers who care about readable structure, fast iteration, and maintainable MVC code.</p>
                    </article>
                </div>
            </section>

            <section class="section" id="why-lima">
                <div class="container">
                    <div class="section-heading">
                        <p class="eyebrow">Why developers lean in</p>
                        <h2>Designed to feel modern, fast, and honest about what a PHP framework should do.</h2>
                        <p>Lima gives you structure where it matters and gets out of the way where it does not. That balance is exactly what makes it appealing for developers evaluating a new framework.</p>
                    </div>
                    <div class="pillar-grid">
                        <?php foreach ($pillars as $pillar): ?>
                            <article class="pillar-card">
                                <div class="card-icon"><?php echo lucide_icon($pillar['icon'] ?? 'code'); ?></div>
                                <h3><?php echo e($pillar['title'] ?? ''); ?></h3>
                                <p><?php echo e($pillar['copy'] ?? ''); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="section section-alt" id="developer-flow">
                <div class="container split-section">
                    <div class="section-heading compact">
                        <p class="eyebrow">Developer flow</p>
                        <h2>From install to render, the architecture stays easy to reason about.</h2>
                        <p>That clarity matters when you are building quickly, handing projects to teammates, or marketing a framework to developers who have already seen too much unnecessary complexity.</p>
                    </div>
                    <div class="workflow-list">
                        <?php foreach ($workflow as $item): ?>
                            <article class="workflow-card">
                                <p class="workflow-step"><?php echo e($item['step'] ?? ''); ?></p>
                                <h3><?php echo e($item['title'] ?? ''); ?></h3>
                                <p><?php echo e($item['copy'] ?? ''); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container cta-panel">
                    <div class="cta-content">
                        <p class="eyebrow">Learn Lima faster</p>
                        <h2>Documentation is where curiosity turns into adoption.</h2>
                        <p>Developers evaluating a framework want a short path from interest to understanding. Send them straight to the official docs and keep that journey friction-free.</p>
                    </div>
                    <a class="button button-primary" href="<?php echo e($docsUrl); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo lucide_icon('book-open'); ?>
                        <span>Open the docs</span>
                    </a>
                </div>
            </section>

            <section class="section section-faq" id="faq">
                <div class="container">
                    <div class="section-heading compact">
                        <p class="eyebrow">Questions developers ask</p>
                        <h2 class="mb-2">Answer the adoption blockers before they slow momentum.</h2>
                    </div>
                    <div class="faq-list">
                        <?php foreach ($faqs as $faq): ?>
                            <details class="faq-item">
                                <summary><?php echo e($faq['question'] ?? ''); ?></summary>
                                <p><?php echo e($faq['answer'] ?? ''); ?></p>
                            </details>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </main>

        <?php $view->get_footer(); ?>