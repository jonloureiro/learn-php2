<?php

declare(strict_types=1);

namespace MinhasHoras;

use Psr\Http\Message\ServerRequestInterface;
use MinhasHoras\Lib\Emitter\EmitterInterface;
use MinhasHoras\Lib\Route\RouterInterface;

class App
{
    public function __construct(
        ServerRequestInterface $serverRequest,
        RouterInterface $router,
        EmitterInterface $emitter
    ) {
        $response = $router->dispatch($serverRequest);
        $emitter->emit($response);
    }
}
