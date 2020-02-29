<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use MinhasHoras\Middlewares\ErrorMiddleware;
use League\Route\Router as LeagueRouter;
use League\Route\Strategy\JsonStrategy as LeagueJsonStrategy;

class Router implements RouterInterface
{
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

    public function api(string $method, string $path, $handler): void
    {
        $this->api->map($method, $path, $handler);
    }
}
