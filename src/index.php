<?php

ini_set("display_errors", 1);

use App\Api\Hello\HelloController;
use App\Lib\Strategy\ApiStrategy;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\RouteGroup;
use League\Route\Router;

require_once dirname(__DIR__) . "/vendor/autoload.php";

// $isGet = strtolower($_SERVER['REQUEST_METHOD']) === 'get';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$responseFactory = new ResponseFactory();
$router = new Router();


if ($isApi) {
    $strategy = new ApiStrategy($responseFactory);
    $routes = $router->group('/api', function (RouteGroup $route) {
        $route->map('GET', '/hello', [HelloController::class, 'world']);
    });
    $routes->setStrategy($strategy);
}
// } else {
//     routesClient($router);
// }

$response = $router->dispatch($request);
(new SapiEmitter)->emit($response);
