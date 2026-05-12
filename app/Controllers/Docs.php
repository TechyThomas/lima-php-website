<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;
use Parsedown;

class Docs extends Controller
{
    private function getDocsSchema(string $title, string $description, string $canonical, array $docSchema = []): array
    {
        $siteUrl = rtrim($_ENV['SITE_URL'] ?? site_url(), '/');

        $articleSchema = array_merge([
            '@type' => 'TechArticle',
            '@id' => $canonical . '#article',
            'headline' => $title,
            'description' => $description,
            'url' => $canonical,
            'inLanguage' => 'en-GB',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonical,
            ],
            'about' => [
                '@id' => $siteUrl . '#software',
            ],
        ], $docSchema);

        $articleSchema['@id'] = $articleSchema['@id'] ?? $canonical . '#article';
        $articleSchema['url'] = $articleSchema['url'] ?? $canonical;
        $articleSchema['mainEntityOfPage'] = $articleSchema['mainEntityOfPage'] ?? [
            '@type' => 'WebPage',
            '@id' => $canonical,
        ];

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => $siteUrl . '#website',
                    'name' => 'Lima PHP',
                    'url' => $siteUrl,
                    'description' => 'Lima is a PHP MVC framework.',
                    'inLanguage' => 'en-GB',
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $siteUrl . '#software',
                    'name' => 'Lima MVC',
                    'url' => $siteUrl,
                    'applicationCategory' => 'DeveloperApplication',
                    'operatingSystem' => 'Cross-platform',
                    'programmingLanguage' => 'PHP',
                    'description' => 'Lima is a simple, expandable PHP MVC framework.',
                    'softwareHelp' => $siteUrl . '/docs',
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $canonical,
                    'name' => $title,
                    'url' => $canonical,
                    'description' => $description,
                    'isPartOf' => [
                        '@id' => $siteUrl . '#website',
                    ],
                    'about' => [
                        '@id' => $siteUrl . '#software',
                    ],
                ],
                $articleSchema,
            ],
        ];
    }

    private function getDocs(): array {
        $jsonFile = LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'docs.json';

        if (!file_exists($jsonFile)) {
            return [];
        }

        $jsonContents = file_get_contents($jsonFile);

        if (!json_validate($jsonContents)) {
            return [];
        }

        return json_decode($jsonContents, true);
    }

    public function index(string $slug = ''): void
    {
        if (!empty($slug)) {
            $this->getDocPage($slug);
            exit;
        }

        $this->view('docs/index', [
            'docs' => $this->getDocs(),
            'page' => [
                'title' => doc_title('Lima Docs')
            ]
        ]);
    }

    private function getDocPage(string $slug) {
        $allDocs = $this->getDocs();
        
        $docsDir = LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'docs';
        $docFile = $docsDir . DIRECTORY_SEPARATOR . $slug . '.md';

        if (empty($allDocs[$slug]) || !file_exists($docFile)) {
            http_response_code(404);
            $this->view('docs/404', [
                'docs' => $allDocs,
            ]);
            exit;
        }

        $parsedown = new Parsedown();

        $markdown = $parsedown->text(file_get_contents($docFile));
        $doc = $allDocs[$slug];
        $canonical = page_url('docs/' . $slug);
        $title = $doc['title'] . ' - Lima Docs';
        $description = $doc['description'] ?? 'Learn more about Lima MVC.';

        $this->view('docs/single', [
            'docs' => $allDocs,
            'content' => $markdown,
            'current_doc' => $slug,
            'page' => [
                'title' => doc_title($title),
                'description' => $description,
                'canonical' => $canonical
            ],
            'schema' => $this->getDocsSchema($title, $description, $canonical, $doc['schema'] ?? []),
        ]);
    }
}
