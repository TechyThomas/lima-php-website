<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;

class Home extends Controller {
    public function index() {
        $siteUrl = rtrim($_ENV['SITE_URL'], '/');
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

        $highlights = [
            [
                'label' => 'Routing + Controllers',
                'copy' => 'Keep request handling deliberate, readable, and easy to extend.',
                'icon' => 'signpost',
            ],
            [
                'label' => 'Twig Support',
                'copy' => 'Render with plain PHP or reach for Twig when your team wants template ergonomics.',
                'icon' => 'sparkles',
            ],
            [
                'label' => 'Composer Package',
                'copy' => 'Install Lima with Composer and slot it into a workflow PHP developers already know.',
                'icon' => 'package',
            ],
            [
                'label' => 'MVC Without Bloat',
                'copy' => 'Bring structure to your project without drowning simple ideas in ceremony.',
                'icon' => 'layers',
            ],
        ];

        $pillars = [
            [
                'title' => 'Build with momentum',
                'copy' => 'Lima gives developers a predictable MVC flow so you can move from route to controller to view without hunting through abstraction layers.',
                'icon' => 'rocket',
            ],
            [
                'title' => 'Stay close to PHP',
                'copy' => 'Use familiar PHP patterns, keep your code approachable, and add Twig only when it genuinely improves the developer experience.',
                'icon' => 'code',
            ],
            [
                'title' => 'Ship polished products',
                'copy' => 'The framework is a strong fit for landing pages, internal tools, client projects, and websites that need clear structure and quick iteration.',
                'icon' => 'monitor',
            ],
        ];

        $workflow = [
            [
                'step' => 'Install',
                'title' => 'Bring Lima in with Composer',
                'copy' => 'Start with a package PHP developers already understand, then shape the project around your routes, controllers, and views.',
            ],
            [
                'step' => 'Organise',
                'title' => 'Keep your MVC layers intentional',
                'copy' => 'Controllers stay focused, templates stay readable, and your directory structure tells a clear story to the next developer.',
            ],
            [
                'step' => 'Render',
                'title' => 'Choose PHP templates or Twig',
                'copy' => 'Stay lean with PHP views or use Twig when your team wants reusable templating conventions and presentation guardrails.',
            ],
        ];

        $faqs = [
            [
                'question' => 'What kind of PHP projects is Lima suited to?',
                'answer' => 'Lima fits websites, product landing pages, internal tools, and custom applications where a clean MVC structure matters more than a sprawling feature set.',
            ],
            [
                'question' => 'Can Lima render Twig templates?',
                'answer' => 'Yes. Lima can render standard PHP views, and it also supports Twig when Twig is available in the project. To enable support, all you need to do is install the Twig composer package. Lima will auto detect it and allow serving of Twig templates.',
            ],
            [
                'question' => 'How do I learn the framework quickly?',
                'answer' => 'Start with the official documentation, then wire up a route, controller, and template. Lima is easiest to learn by following the request flow end to end.',
            ],
            [
                'question' => 'Why pitch Lima to experienced developers?',
                'answer' => 'Because experienced PHP developers often want less ceremony, more clarity, and tooling choices that support their workflow instead of dictating it.',
            ],
        ];

        $codeSamples = [
            'install' => "composer require spacecow/lima-mvc",
            'route' => "\$routes = [\n    '*' => ['namespace' => 'App\\\\Controllers'],\n];",
            'controller' => "class Home extends Controller\n{\n    public function index()\n    {\n        \$this->view('home');\n    }\n}",
            'view' => "<section class=\"hero\">\n    <h1>{{ title|default('Build with Lima') }}</h1>\n    <p>Render with PHP or Twig.</p>\n</section>",
        ];

        $this->view('home', [
            'page' => $page,
            'highlights' => $highlights,
            'pillars' => $pillars,
            'workflow' => $workflow,
            'faqs' => $faqs,
            'codeSamples' => $codeSamples,
        ]);
    }

    private function detectSiteUrl(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';

        if ($host === '') {
            return '';
        }

        $scheme = 'http';

        if (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        ) {
            $scheme = 'https';
        }

        return $scheme . '://' . $host;
    }
}
