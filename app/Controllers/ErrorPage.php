<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;

class ErrorPage extends Controller
{
    public function not_found(): void
    {
        $siteUrl = rtrim($_ENV['SITE_URL'] ?? '', '/');

        $this->view('404', [
            'page' => [
                'title' => 'Page Not Found | Lima PHP',
                'description' => 'The page you requested could not be found.',
                'canonical' => $siteUrl !== '' ? $siteUrl . '/404' : '/404',
                'site_name' => 'Lima PHP',
                'og_image' => $siteUrl !== '' ? $siteUrl . '/assets/images/og-card.svg' : '/assets/images/og-card.svg',
                'docs_url' => 'https://docs.limaphp.com',
                'font_family' => 'Space Grotesk',
            ],
        ]);
    }
}
