<?php

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__FILE__) . "/routes.php";

// $isGet = strtolower($_SERVER['REQUEST_METHOD']) === 'get';
$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();

if ($isApi) {
    routesApi($router);
} else {
    routesClient($router);
}

$response = $router->dispatch($request);
(new SapiEmitter)->emit($response);
