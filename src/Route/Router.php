<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use League\Route\Router as LeagueRouter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    public $router;

    public function __construct()
    {
        $this->router = new LeagueRouter();
    }

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}
