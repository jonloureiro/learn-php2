<?php

declare(strict_types=1);

use MinhasHoras\App;
use MinhasHoras\Lib\Emitter\Emitter;
use MinhasHoras\Lib\Route\Router;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$serverRequest = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();

$router->map('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

$emitter = new Emitter();

new App($serverRequest, $router, $emitter);
