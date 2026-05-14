<?php

$routes = [
    '404' => [
        'namespace' => 'LimaSite\Controllers',
        'controller' => 'ErrorPage',
        'method' => 'not_found',
    ],
    'docs' => [
        'namespace' => 'LimaSite\Controllers',
        'controller' => 'Docs',
        'method' => 'index',
    ],
    '*' => ['namespace' => 'LimaSite\Controllers'],
];
