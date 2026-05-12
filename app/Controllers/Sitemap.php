<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use DateTime;
use Lima\Core\Controller;

class Sitemap extends Controller
{
    private function getDocs(): array
    {
        $jsonFile = LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'docs.json';

        if (!file_exists($jsonFile)) {
            return [];
        }

        $jsonContents = file_get_contents($jsonFile);

        if (!json_validate($jsonContents)) {
            return [];
        }

        $docs = json_decode($jsonContents, true);

        $docFiles = [];

        foreach ($docs as $docSlug => $doc) {
            $docDate = filemtime(LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'docs' . DIRECTORY_SEPARATOR . $docSlug . '.md');

            $dt = DateTime::createFromTimestamp($docDate);

            $docFiles[] = [
                'url' => page_url('docs/' . $docSlug),
                'date' => $dt->format('Y-m-d')
            ];
        }

        return $docFiles;
    }

    public function index()
    {
        $templateFile = LIMA_ROOT . DIRECTORY_SEPARATOR . $_ENV['LIMA_TEMPLATE_DIR'] . '/sitemap.php';

        ob_start();
        $docFiles = $this->getDocs();
        require($templateFile);
        $sitemap = ob_get_clean();

        header('Content-Type: text/xml');
        header('Content-Length: ' . strlen($sitemap));

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo $sitemap;
    }
}