<?php

declare(strict_types=1);

namespace MinhasHoras\Lib\Route;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Route\Route as LeagueRoute;
use League\Route\Router as LeageRouter;

class Router implements RouterInterface
{
    public $router;

    public function __construct()
    {
        $this->router = new LeageRouter();
    }

    public function dispatch(RequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }

    public function map(string $method, string $path, $handler): LeagueRoute
    {
        return $this->router->map($method, $path, $handler);
    }
}
