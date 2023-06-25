<?php

// index.php

require_once 'vendor/autoload.php';



use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function(RouteCollector $router) {
    $router->get('/add', ['App\\Controller\\FormController', 'index']);
    $router->post('/home', ['App\\Controller\\HomeController', 'index']);
    // Add more routes as needed
});

// Fetch the HTTP method and URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove query parameters from the URI
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

// Dispatch the request to the appropriate controller method
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
print_r($routeInfo);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Handle 404 Not Found error
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Handle 405 Method Not Allowed error
        break;
    case FastRoute\Dispatcher::FOUND:
        var_dump($routeInfo[1]);
        var_dump($routeInfo[2]);
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controllerClass, $method] = $handler;

        // Create an instance of the controller class
        $controller = new $controllerClass();

        // Call the method on the controller
        call_user_func_array([$controller, $method], $vars);
        break;
}