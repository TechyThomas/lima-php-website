<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;
use Parsedown;

class Docs extends Controller
{
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

        if (!file_exists($docFile)) {
            http_response_code(404);
            $this->view('docs/404', [
                'docs' => $allDocs,
            ]);
            exit;
        }

        $parsedown = new Parsedown();

        $markdown = $parsedown->text(file_get_contents($docFile));

        $this->view('docs/single', [
            'docs' => $allDocs,
            'content' => $markdown,
            'current_doc' => $slug,
            'page' => [
                'title' => doc_title($allDocs[$slug]['title'] . ' - Lima Docs'),
                'canonical' => page_url('docs/' . $slug)
            ]
        ]);
    }
}
