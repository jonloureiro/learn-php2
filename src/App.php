<?php

declare(strict_types=1);

namespace MinhasHoras;

use MinhasHoras\Http\EmitterInterface;
use MinhasHoras\Route\RouterInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;

class App
{
    public function __construct(
        ServerRequestFactoryInterface $serverRequestFactory,
        ResponseFactoryInterface $responseFactory,
        RouterInterface $router,
        EmitterInterface $emitter
    ) {
    }
}
