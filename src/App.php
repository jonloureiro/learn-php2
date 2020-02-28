<?php

declare(strict_types=1);

namespace MinhasHoras;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use MinhasHoras\Middlewares\ErrorMiddleware;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;
use Laminas\Diactoros\ServerRequestFactory as LaminasServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter as LaminasEmitter;
use League\Route\Router as LeagueRouter;
use League\Route\RouteGroup as LeagueRouteGroup;
use League\Route\Strategy\JsonStrategy as LeagueJsonStrategy;

class App
{
    public function __construct()
    {
        $serverRequestFactory = new LaminasServerRequestFactory();
        $responseFactory = new LaminasResponseFactory();
        $jsonStrategy = new LeagueJsonStrategy($responseFactory);
        $router = new LeagueRouter();
        $emitter = new LaminasEmitter();

        $serverRequest = $serverRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );


        $apiRouteGroup = $router->group('/api', function () {});
        $apiRouteGroup->middleware(new ErrorMiddleware($responseFactory));
        $apiRouteGroup->setStrategy($jsonStrategy);
        $apiRouteGroup->map('POST', '/', function (ServerRequestInterface $request) : ResponseInterface {
            $responseFactory = new LaminasResponseFactory();
            $response = $responseFactory->createResponse();
            $response->getBody()->write(
                json_encode([
                    "test" => "test"
                ])
            );
            return $response->withStatus(203);
        });


        $response = $router->dispatch($serverRequest);
        $emitter->emit($response);
    }
}
