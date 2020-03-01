<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Route\Strategy\StrategyInterface;

class ClientRouter extends Router
{
    protected function initRoutes(StrategyInterface $strategy): void
    {
        $this->routes = $this->router->group('/', function () {
        });
        $this->routes->setStrategy($strategy);
    }
}
