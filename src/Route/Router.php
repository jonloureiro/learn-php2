<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Route\Strategy\StrategyInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router as LeagueRouter;
use League\Route\Route as LeagueRoute;

abstract class Router implements RouterInterface
{
    protected $router;
    protected $responseFactory;
    protected $routes;

    public function __construct(ResponseFactoryInterface $responseFactory, StrategyInterface $strategy)
    {
        $this->router = new LeagueRouter();
        $this->responseFactory = $responseFactory;
        $this->initRoutes($strategy);
    }

    abstract protected function initRoutes(StrategyInterface $strategy): void;

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }

    public function add(string $method, string $path, $handler): LeagueRoute
    {
        return $this->routes->map($method, $path, $handler);
    }
}
