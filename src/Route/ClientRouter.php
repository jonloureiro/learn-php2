<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Route\Strategy\ApplicationStrategy;

class ClientRouter extends Router
{
    protected function initRoutes(): void
    {
        $this->routes = $this->router->group('/', function () {
        });
        $this->routes->setStrategy(new ApplicationStrategy($this->responseFactory));
    }
}
