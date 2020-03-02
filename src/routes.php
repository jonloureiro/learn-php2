<?php

declare(strict_types=1);

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function routesApi($router): void
{
    $router->map('GET', '/api', function (ServerRequestInterface $request) : ResponseInterface {
        $response = new Response();
        $response->getBody()->write(
            json_encode([
            "hello" => "world"
          ])
        );
        return $response;
    });
}

function routesClient($router): void
{
    $router->map('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
        $response = new Response();
        $response->getBody()->write("<h2>Hello World</h2>");
        return $response;
    });
}
