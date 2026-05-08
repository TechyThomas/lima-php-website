<?php

declare(strict_types=1);

$page = $page ?? [];
$docsPages = $docsPages ?? [];
$currentDoc = $currentDoc ?? null;
$docContent = $docContent ?? '';

if (!class_exists('\LimaSite\Support\MarkdownRenderer')) {
    require_once LIMA_ROOT . '/app/Support/MarkdownRenderer.php';
}

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
            'book-open' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
            'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
            'file-text' => '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M8 13h8"/><path d="M8 17h8"/><path d="M10 9h1"/>',
            'house' => '<path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5"/>',
        ];

        $paths = $icons[$icon] ?? $icons['file-text'];
        $class = $className !== '' ? ' ' . $className : '';

        return '<svg class="icon' . $class . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $paths . '</svg>';
    }
}

if (!function_exists('docs_slugify')) {
    function docs_slugify(string $value): string
    {
        return preg_replace('/[^a-z0-9-]/', '', strtolower($value)) ?? '';
    }
}

if (!function_exists('docs_humanize_title')) {
    function docs_humanize_title(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}

if (!function_exists('docs_discover_pages')) {
    /**
     * @return array<int, array{slug:string,title:string,path:string,url:string}>
     */
    function docs_discover_pages(string $docsDir): array
    {
        if (!is_dir($docsDir)) {
            return [];
        }

        $files = glob($docsDir . DIRECTORY_SEPARATOR . '*.md') ?: [];
        sort($files, SORT_NATURAL | SORT_FLAG_CASE);

        $pages = [];
        foreach ($files as $file) {
            $slug = docs_slugify(pathinfo($file, PATHINFO_FILENAME));
            if ($slug === '') {
                continue;
            }

            $pages[] = [
                'slug' => $slug,
                'title' => docs_humanize_title($slug),
                'path' => $file,
                'url' => '/docs?page=' . rawurlencode($slug),
            ];
        }

        return $pages;
    }
}

if ($docsPages === [] || $currentDoc === null || trim($docContent) === '') {
    $docsDir = LIMA_ROOT . '/static/docs';
    $docsPages = docs_discover_pages($docsDir);
    $requestedSlug = docs_slugify($_GET['page'] ?? '');

    if ($docsPages !== []) {
        $currentDoc = $docsPages[0];

        foreach ($docsPages as $doc) {
            if ($doc['slug'] === $requestedSlug) {
                $currentDoc = $doc;
                break;
            }
        }

        $markdown = file_get_contents($currentDoc['path']) ?: '';
        $renderer = new \LimaSite\Support\MarkdownRenderer();
        $docContent = $renderer->render($markdown);
    } else {
        $docContent = '<p>No documentation files were found in <code>static/docs</code>.</p>';
    }
}

$title = $page['title'] ?? 'Lima PHP Docs';
$description = $page['description'] ?? 'Lima PHP documentation.';
$canonical = $page['canonical'] ?? '/docs';
$siteName = $page['site_name'] ?? 'Lima PHP';
$ogImage = $page['og_image'] ?? '/assets/images/og-card.svg';
$docsUrl = $page['docs_url'] ?? 'https://docs.limaphp.com';
$fontFamily = $page['font_family'] ?? 'Space Grotesk';

$currentTitle = is_array($currentDoc) ? ($currentDoc['title'] ?? 'Documentation') : 'Documentation';
$currentSlug = is_array($currentDoc) ? ($currentDoc['slug'] ?? '') : '';

$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            'name' => $title,
            'url' => $canonical,
            'description' => $description,
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => $canonical,
            ],
        ],
        [
            '@type' => 'TechArticle',
            'headline' => $currentTitle,
            'description' => $description,
            'url' => $canonical,
            'author' => [
                '@type' => 'Organization',
                'name' => $siteName,
            ],
        ],
    ],
];
?>
<!doctype html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title); ?></title>
    <meta name="description" content="<?= e($description); ?>">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="theme-color" content="#0b1020">
    <link rel="canonical" href="<?= e($canonical); ?>">
    <link rel="icon" href="/assets/images/logo-mark.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="/assets/css/style.css" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=<?= e(str_replace(' ', '+', $fontFamily)); ?>:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="<?= e($siteName); ?>">
    <meta property="og:title" content="<?= e($title); ?>">
    <meta property="og:description" content="<?= e($description); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:image" content="<?= e($ogImage); ?>">
    <meta property="og:image:alt" content="Lima PHP documentation page">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($title); ?>">
    <meta name="twitter:description" content="<?= e($description); ?>">
    <meta name="twitter:image" content="<?= e($ogImage); ?>">

    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?></script>
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
                        <p class="eyebrow">Lima documentation</p>
                        <h1><?= e($currentTitle); ?></h1>
                        <p>Edit the markdown files in <code>static/docs</code> and this docs area will pick them up automatically. Add a new file and it becomes a new section in the sidebar.</p>
                    </div>
                </div>
            </section>

            <section class="docs-layout-section">
                <div class="container docs-layout">
                    <aside class="docs-sidebar-wrap">
                        <div class="docs-sidebar">
                            <p class="docs-sidebar-label"><?= lucide_icon('file-text'); ?><span>Documentation</span></p>
                            <nav aria-label="Documentation pages">
                                <?php foreach ($docsPages as $doc): ?>
                                    <a class="docs-nav-link<?= $currentSlug === $doc['slug'] ? ' is-active' : ''; ?>" href="<?= e($doc['url']); ?>">
                                        <span><?= e($doc['title']); ?></span>
                                        <?= lucide_icon('chevron-right'); ?>
                                    </a>
                                <?php endforeach; ?>
                            </nav>
                            <a class="docs-home-link" href="/">
                                <?= lucide_icon('house'); ?>
                                <span>Back to homepage</span>
                            </a>
                        </div>
                    </aside>

                    <article class="docs-content">
                        <div class="docs-prose">
                            <?= $docContent; ?>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
