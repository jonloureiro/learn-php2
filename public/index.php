<?php

declare(strict_types=1);

use MinhasHoras\App;
use MinhasHoras\Routes;
use MinhasHoras\Lib\Emitter\Emitter;
use MinhasHoras\Lib\Route\Router;
use Laminas\Diactoros\ServerRequestFactory as LaminasServerRequestFactory;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

$serverRequestFactory = new  LaminasServerRequestFactory();
$responseFactory = new LaminasResponseFactory();

$serverRequest = $serverRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();
$routes = new Routes($router, $responseFactory);

$emitter = new Emitter();

new App($serverRequest, $routes->getRouter(), $emitter);
