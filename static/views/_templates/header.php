<?php

declare(strict_types=1);

$page = $page ?? [];
$title = $page['title'] ?? 'Lima PHP Framework';
$description = $page['description'] ?? 'Lima is a PHP MVC framework.';
$canonical = $page['canonical'] ?? '/';
$siteName = $page['site_name'] ?? 'Lima PHP';
$ogImage = $page['og_image'] ?? '/assets/images/og-card.svg';
$docsUrl = $page['docs_url'] ?? 'https://docs.limaphp.com';
$fontFamily = $page['font_family'] ?? 'Space Grotesk';
$schema = $schema ?? [
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
?>
<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title); ?></title>
    <meta name="description" content="<?php echo e($description); ?>">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="theme-color" content="#0b1020">
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <link rel="icon" href="/assets/images/logo-mark.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="/assets/css/style.css" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=<?php echo e(str_replace(' ', '+', $fontFamily)); ?>:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo e($siteName); ?>">
    <meta property="og:title" content="<?php echo e($title); ?>">
    <meta property="og:description" content="<?php echo e($description); ?>">
    <meta property="og:url" content="<?php echo e($canonical); ?>">
    <meta property="og:image" content="<?php echo e($ogImage); ?>">
    <meta property="og:image:alt" content="Lima PHP framework promotional card">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($title); ?>">
    <meta name="twitter:description" content="<?php echo e($description); ?>">
    <meta name="twitter:image" content="<?php echo e($ogImage); ?>">

    <script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?></script>
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
                <nav class="nav-links nav-links-desktop" aria-label="Primary">
                    <a href="#why-lima">Why Lima</a>
                    <a href="#developer-flow">Developer Flow</a>
                    <a href="#faq">FAQ</a>
                    <a class="button button-secondary" href="<?php echo e($docsUrl); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo lucide_icon('book-open'); ?>
                        <span>Read docs</span>
                    </a>
                </nav>
                <div class="site-menu">
                    <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobile-navigation">
                        <span class="menu-toggle-label">Menu</span>
                        <span class="menu-toggle-icon" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                    <button class="menu-backdrop" type="button" aria-label="Close navigation" tabindex="-1"></button>
                    <div class="mobile-flyout" id="mobile-navigation" role="dialog" aria-modal="true" aria-label="Mobile navigation">
                        <div class="mobile-flyout-header">
                            <span class="mobile-flyout-title">Navigate</span>
                            <button class="menu-close" type="button" aria-label="Close navigation">
                                <?php echo lucide_icon('x'); ?>
                            </button>
                        </div>
                        <nav class="nav-links nav-links-mobile" aria-label="Primary">
                            <a href="#why-lima">Why Lima</a>
                            <a href="#developer-flow">Developer Flow</a>
                            <a href="#faq">FAQ</a>
                            <a class="button button-secondary" href="<?php echo e($docsUrl); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo lucide_icon('book-open'); ?>
                                <span>Read docs</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main id="main-content">
