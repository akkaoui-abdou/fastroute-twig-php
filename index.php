<?php

require_once 'vendor/autoload.php';
$routes = require_once __DIR__.'/config/routes.php';

$injection = [];

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$template = new Twig\Environment($loader, ['cache' => false]);

$injection['template'] = $template;

$dispatcher = FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) use ($routes) {
    foreach ($routes as $route) {
        $r->addRoute($route['method'], $route['path'], $route['controller']);
    }
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::FOUND:
        $explode = explode(':', $routeInfo[1]);

        call_user_func_array([new $explode[0]($injection), $explode[1]], [$routeInfo[2]]);
        break;
}

/*switch ($_SERVER['REQUEST_URI']) {
    case '/':
        $page = new Tutorial\Fastroute\Controller\IndexController($injection);
        $page->index();
        break;

    case '/list':
        $page = new Tutorial\Fastroute\Controller\LinksController($injection);
        $page->index();
        break;

    case '/add':
        $page = new Tutorial\Fastroute\Controller\LinksController($injection);
        $page->add();
        break;
}*/
