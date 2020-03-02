<?php

use App\Api\Hello\HelloController;
use App\Client\Login\LoginPage;
use App\Lib\Strategy\ApiStrategy;
use App\Lib\Strategy\ClientStrategy;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Plates\Engine;
use League\Route\RouteGroup;
use League\Route\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$env = parse_ini_file(
    dirname(__DIR__) . '/config/.env'
);

if ($env) {
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

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
} else {
    $templates = new Engine(dirname(__DIR__) . '/templates');
    $strategy = new ClientStrategy($responseFactory, $templates);
    $routes = $router->group('/', function (RouteGroup $route) {
        $route->map('GET', '/login', LoginPage::class);
    });
    $routes->setStrategy($strategy);
}

$response = $router->dispatch($request);
(new SapiEmitter)->emit($response);
