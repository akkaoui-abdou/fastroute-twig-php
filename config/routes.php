<?php

return [
    [
        'method' => 'GET',
        'path' => '/',
        'controller' => 'App\\Controller\\IndexController:index'
    ],
    [
        'method' => 'GET',
        'path' => '/list',
        'controller' => 'App\\Controller\\LinksController:index'
    ],
    [
        'method' => ['GET', 'POST'],
        'path' => '/add',
        'controller' => 'App\\Controller\\LinksController:add'
    ],
];
