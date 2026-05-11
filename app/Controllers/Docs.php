<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;

class Docs extends Controller
{
    public function index(): void
    {
        $docsDir = LIMA_ROOT . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'docs';

        $this->view('docs', [
        ]);
    }
}
