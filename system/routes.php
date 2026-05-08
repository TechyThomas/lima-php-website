<?php

$routes = [
    'docs' => [
        'namespace' => 'LimaSite\Controllers',
        'controller' => 'Docs',
        'method' => 'index',
    ],
    '*' => ['namespace' => 'LimaSite\Controllers'],
];
