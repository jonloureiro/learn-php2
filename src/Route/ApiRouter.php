<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Route\Strategy\JsonStrategy;

class ApiRouter extends Router
{
    protected function initRoutes(): void
    {
        $this->routes = $this->router->group('/api', function () {
        });
        $this->routes->setStrategy(new JsonStrategy($this->responseFactory));
    }
}
