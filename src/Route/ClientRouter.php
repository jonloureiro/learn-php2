<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

class ClientRouter extends Router
{
    protected function initRoutes(): void
    {
        $this->routes = $this->router->group('/', function () {
        });
    }
}
