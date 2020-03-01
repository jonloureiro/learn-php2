<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use MinhasHoras\Route\Strategy\StrategyInterface;

class ApiRouter extends Router
{
    protected function initRoutes(StrategyInterface $strategy): void
    {
        $this->routes = $this->router->group('/api', function () {
        });
        $this->routes->setStrategy($strategy);
    }
}
