<?php

declare(strict_types=1);

$page = $page ?? $data['page'] ?? [];
$pillars = $pillars ?? $data['pillars'] ?? [];
$workflow = $workflow ?? $data['workflow'] ?? [];
$faqs = $faqs ?? $data['faqs'] ?? [];
$codeSamples = $codeSamples ?? $data['codeSamples'] ?? [];

$title = $page['title'] ?? 'Lima PHP Framework';
$description = $page['description'] ?? 'Lima is a PHP MVC framework.';
$canonical = $page['canonical'] ?? '/';
$siteName = $page['site_name'] ?? 'Lima PHP';
$ogImage = $page['og_image'] ?? '/assets/images/og-card.svg';
$docsUrl = $page['docs_url'] ?? '/docs';
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
                <a class="button button-primary" href="<?php echo e($docsUrl); ?>">
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
                        <pre><code><?php echo e($codeSamples['install'] ?? ''); ?></code></pre>
                    </div>
                    <div class="terminal-block">
                        <p class="panel-label"><?php echo lucide_icon('terminal'); ?><span>Install the starter project</span></p>
                        <pre><code><?php echo e($codeSamples['install_project'] ?? ''); ?></code></pre>
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
                    <summary>
                        <span><?php echo e($faq['question'] ?? ''); ?></span>
                        <span class="faq-toggle-icon" aria-hidden="true"><?php echo lucide_icon('chevron-down'); ?></span>
                    </summary>
                    <p><?php echo e($faq['answer'] ?? ''); ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php $view->get_footer(); ?>
