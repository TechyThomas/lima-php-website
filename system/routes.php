<?php

$routes = [
    '404' => [
        'namespace' => 'LimaSite\Controllers',
        'controller' => 'ErrorPage',
        'method' => 'not_found',
    ],
    '*' => ['namespace' => 'LimaSite\Controllers'],
];
