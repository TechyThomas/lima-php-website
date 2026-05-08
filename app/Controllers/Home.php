<?php

declare(strict_types=1);

namespace LimaSite\Controllers;

use Lima\Core\Controller;

class Home extends Controller {
    public function index() {
        $this->view('home');
    }
}