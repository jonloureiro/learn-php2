<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Middlewares\ErrorMiddleware;
use League\Route\Strategy\JsonStrategy as LeagueJsonStrategy;

class ApiRouter extends Router
{
    protected function initRoutes(): void
    {
        $this->routes = $this->router->group('/api', function () {
        });
        $this->routes->middleware(new ErrorMiddleware($this->responseFactory));
        $this->routes->setStrategy(new LeagueJsonStrategy($this->responseFactory));
    }
}
