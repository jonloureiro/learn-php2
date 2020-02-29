<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Middlewares\ErrorMiddleware;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router as LeagueRouter;
use League\Route\Strategy\JsonStrategy as LeagueJsonStrategy;
use League\Route\Route as LeagueRoute;

class Router implements RouterInterface
{
    private $router;
    private $api;
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->router = new LeagueRouter();
        $this->api = $this->router->group('/api', function () {
        });
        $this->api->middleware(new ErrorMiddleware($responseFactory));
        $this->api->setStrategy(new LeagueJsonStrategy($responseFactory));
    }

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }

    public function api(string $method, string $path, $handler): LeagueRoute
    {
        return $this->api->map($method, $path, $handler);
    }
}
