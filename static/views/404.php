<?php

declare(strict_types=1);

$page = $page ?? [];

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
            'arrow-left' => '<path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>',
            'book-open' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
            'house' => '<path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5"/>',
        ];

        $paths = $icons[$icon] ?? $icons['house'];
        $class = $className !== '' ? ' ' . $className : '';

        return '<svg class="icon' . $class . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $paths . '</svg>';
    }
}

$title = $page['title'] ?? 'Page Not Found | Lima PHP';
$description = $page['description'] ?? 'The page you requested could not be found.';
$canonical = $page['canonical'] ?? '/404';
$siteName = $page['site_name'] ?? 'Lima PHP';
$ogImage = $page['og_image'] ?? '/assets/images/og-card.svg';
$docsUrl = $page['docs_url'] ?? 'https://docs.limaphp.com';
$fontFamily = $page['font_family'] ?? 'Space Grotesk';
?>
<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title); ?></title>
    <meta name="description" content="<?= e($description); ?>">
    <meta name="robots" content="noindex,follow">
    <meta name="theme-color" content="#0b1020">
    <link rel="canonical" href="<?= e($canonical); ?>">
    <link rel="icon" href="/assets/images/logo-mark.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="/assets/css/style.css" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=<?= e(str_replace(' ', '+', $fontFamily)); ?>:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e($siteName); ?>">
    <meta property="og:title" content="<?= e($title); ?>">
    <meta property="og:description" content="<?= e($description); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:image" content="<?= e($ogImage); ?>">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <div class="site-shell">
        <header class="site-header">
            <div class="container nav">
                <a class="brand" href="/" aria-label="Lima PHP home">
                    <img src="/assets/images/logo-mark.svg" width="40" height="40" alt="">
                    <span>Lima PHP</span>
                </a>
                <nav class="nav-links" aria-label="Primary">
                    <a href="/">Home</a>
                    <a href="/docs">Docs</a>
                    <a class="button button-secondary" href="<?= e($docsUrl); ?>" target="_blank" rel="noopener noreferrer">
                        <?= lucide_icon('book-open'); ?>
                        <span>Official docs</span>
                    </a>
                </nav>
            </div>
        </header>

        <main id="main-content" class="docs-page">
            <section class="docs-hero">
                <div class="container">
                    <div class="section-heading docs-heading">
                        <p class="eyebrow">404 error</p>
                        <h1>The page you were looking for has drifted out of route.</h1>
                        <p>The URL might be outdated, mistyped, or no longer available. Head back to the homepage or jump into the docs to keep exploring Lima.</p>
                    </div>

                    <div class="cta-panel">
                        <div class="cta-content">
                            <p class="eyebrow">Quick recovery</p>
                            <h2>Pick a safer path.</h2>
                            <p>Everything else on the site is still intact, so you can get back on track in one click.</p>
                        </div>
                        <div class="hero-actions">
                            <a class="button button-primary" href="/">
                                <?= lucide_icon('house'); ?>
                                <span>Go home</span>
                            </a>
                            <a class="button button-ghost" href="/docs">
                                <?= lucide_icon('arrow-left'); ?>
                                <span>Browse docs</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
