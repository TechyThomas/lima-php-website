<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;
use LimaSite\Support\MarkdownRenderer;

require_once dirname(__DIR__) . '/Support/MarkdownRenderer.php';

class Docs extends Controller
{
    public function index(): void
    {
        $docsDir = LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'docs';
        $siteUrl = rtrim($_ENV['SITE_URL'] ?? '', '/');
        $requestedSlug = $this->sanitizeSlug($_GET['page'] ?? '');

        $pages = $this->discoverPages($docsDir);

        if ($pages === []) {
            http_response_code(404);
            $this->view('docs', [
                'page' => $this->pageMeta($siteUrl, 'Documentation', 'Lima documentation is not available yet.', '/docs'),
                'docsPages' => [],
                'currentDoc' => null,
                'docContent' => '<p>No documentation files were found in <code>static/docs</code>.</p>',
            ]);
            return;
        }

        $currentDoc = $pages[$requestedSlug] ?? reset($pages);
        if ($currentDoc === false) {
            $currentDoc = null;
        }

        if ($currentDoc === null) {
            http_response_code(404);
            return;
        }

        $markdown = file_get_contents($currentDoc['path']) ?: '';
        $renderer = new MarkdownRenderer();

        $docTitle = $currentDoc['title'] . ' Docs';
        $description = 'Read the ' . $currentDoc['title'] . ' documentation for the Lima PHP MVC framework.';

        $this->view('docs', [
            'page' => $this->pageMeta($siteUrl, $docTitle . ' | Lima PHP', $description, '/docs?page=' . rawurlencode($currentDoc['slug'])),
            'docsPages' => array_values($pages),
            'currentDoc' => $currentDoc,
            'docContent' => $renderer->render($markdown),
        ]);
    }

    private function sanitizeSlug(string $value): string
    {
        return preg_replace('/[^a-z0-9-]/', '', strtolower($value)) ?? '';
    }

    /**
     * @return array<string, array{slug:string,title:string,path:string,url:string}>
     */
    private function discoverPages(string $docsDir): array
    {
        if (!is_dir($docsDir)) {
            return [];
        }

        $files = glob($docsDir . DIRECTORY_SEPARATOR . '*.md') ?: [];
        sort($files, SORT_NATURAL | SORT_FLAG_CASE);

        $pages = [];

        foreach ($files as $file) {
            $slug = pathinfo($file, PATHINFO_FILENAME);
            $safeSlug = $this->sanitizeSlug($slug);

            if ($safeSlug === '') {
                continue;
            }

            $pages[$safeSlug] = [
                'slug' => $safeSlug,
                'title' => $this->humanizeTitle($safeSlug),
                'path' => $file,
                'url' => '/docs?page=' . rawurlencode($safeSlug),
            ];
        }

        return $pages;
    }

    private function humanizeTitle(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }

    /**
     * @return array<string, string>
     */
    private function pageMeta(string $siteUrl, string $title, string $description, string $path): array
    {
        $canonical = $siteUrl !== '' ? $siteUrl . $path : $path;
        $ogImage = $siteUrl !== '' ? $siteUrl . '/assets/images/og-card.svg' : '/assets/images/og-card.svg';

        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'site_name' => 'Lima PHP',
            'og_image' => $ogImage,
            'docs_url' => 'https://docs.limaphp.com',
            'font_family' => 'Space Grotesk',
        ];
    }
}
