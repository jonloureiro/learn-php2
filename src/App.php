<?php

declare(strict_types=1);

namespace MinhasHoras;

use MinhasHoras\Http\EmitterInterface;
use MinhasHoras\Http\ServerRequestFactoryInterface;
use MinhasHoras\Route\RouterInterface;

class App
{
    public function __construct(
        ServerRequestFactoryInterface $serverRequestFactory,
        RouterInterface $router,
        EmitterInterface $emitter
    ) {
        $serverRequest = $serverRequestFactory->fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );
        $response = $router->dispatch($serverRequest);
        $emitter->emit($response);
    }
}
