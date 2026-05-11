<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;
use LimaSite\Modules\JsonContentLoader;

class Home extends Controller {
    private string $slug = 'home';

    public function index() {
        $siteUrl = rtrim($_ENV['SITE_URL'] ?? site_url(), '/');
        $docsUrl = 'https://docs.limaphp.com';

        $page = [
            'title' => 'Lima PHP Framework | Modern MVC for Developers',
            'description' => 'Lima is a modern PHP MVC framework for developers who want clean structure, optional Twig views, and a fast path from routing to rendered pages.',
            'canonical' => $siteUrl !== '' ? $siteUrl . '/' : '/',
            'site_name' => 'Lima PHP',
            'og_image' => $siteUrl !== '' ? $siteUrl . '/assets/images/og-card.svg' : '/assets/images/og-card.svg',
            'docs_url' => $docsUrl,
            'package_name' => 'spacecow/lima-mvc',
            'font_family' => 'Space Grotesk',
        ];

        $pillars = JsonContentLoader::Load($this->slug, 'pillars');
        $workflow = JsonContentLoader::Load($this->slug, 'workflow');
        $faqs = JsonContentLoader::Load($this->slug, 'faqs');

        $codeSamples = [
            'install' => "composer require spacecow/lima-mvc",
            'install_project' => "composer create-project spacecow/lima-mvc-starter my-project",
            'route' => "\$routes = [\n    '*' => ['namespace' => 'App\\\\Controllers'],\n];",
            'controller' => "class Home extends Controller\n{\n    public function index()\n    {\n        \$this->view('home');\n    }\n}",
            'view' => "<section class=\"hero\">\n    <h1>{{ title|default('Build with Lima') }}</h1>\n    <p>Render with PHP or Twig.</p>\n</section>",
        ];

        $this->view('home', [
            'page' => $page,
            'pillars' => $pillars,
            'workflow' => $workflow,
            'faqs' => $faqs,
            'codeSamples' => $codeSamples,
        ]);
    }
}
