<?php

declare(strict_types=1);

namespace MinhasHoras;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response as LaminasResponse;
use Laminas\Diactoros\ServerRequestFactory as LaminasServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter as LaminasEmitter;
use League\Route\Router as LeagueRouter;

class App
{
    public function __construct()
    {
        $serverRequestFactory = new LaminasServerRequestFactory();
        $router = new LeagueRouter();
        $emitter = new LaminasEmitter();

        $serverRequest = $serverRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $router->map('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
            $response = new LaminasResponse();
            $response->getBody()->write('<h1>Hello, World!</h1>');
            return $response;
        });

        $response = $router->dispatch($serverRequest);

        $emitter->emit($response);
    }
}
