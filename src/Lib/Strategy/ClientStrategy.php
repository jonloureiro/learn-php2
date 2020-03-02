<?php

declare(strict_types=1);

namespace App\Lib\Strategy;

use League\Plates\Engine;
use League\Route\Route;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ClientStrategy extends ApplicationStrategy
{
    protected $responseFactory;
    protected $templates;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        Engine $templates
    ) {
        $this->responseFactory = $responseFactory;
        $this->templates = $templates;
    }

    public function invokeRouteCallable(
        Route $route,
        ServerRequestInterface $request
    ): ResponseInterface {
        $controller = $route->getCallable($this->getContainer());
        $response = $controller(
            $this->templates,
            $this->responseFactory,
            $request,
            $route->getVars()
        );
        $response = $this->applyDefaultResponseHeaders($response);
        return $response;
    }
}
