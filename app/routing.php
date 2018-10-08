<?php
/**
 * Created by PhpStorm.
 * User: Benedicte
 * Date: 08/10/2018
 * Time: 15:34
 */

// routing.php
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['show', '/item/{id}', 'GET'], // action, url, HTTP method
    ],
    'Category' => [ // Controller
        ['showAllCategories', '/categories', 'GET'], // action, url, HTTP method
        ['showOneCategory', '/category/{id}', 'GET'], // action, url, HTTP method
    ]
];