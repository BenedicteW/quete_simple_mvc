<?php
// routing.php
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['show', '/item/{id}', 'GET'], // action, url, HTTP method
        ['add', '/item/add/', ['GET', 'POST']],
        ['edit', '/item/edit/{id}', ['GET', 'POST']],
        ['delete', '/item/delete/{id}', ['GET', 'POST']],
    ],
    'Category' => [ // Controller
        ['index', '/categories', 'GET'], // action, url, HTTP method
        ['show', '/category/{id}', 'GET'], // action, url, HTTP method
        ['add', '/category/add/', ['GET', 'POST']],
        ['edit', '/category/edit/{id}', ['GET', 'POST']],
        ['delete', '/category/delete/{id}', ['GET', 'POST']],
    ],
];