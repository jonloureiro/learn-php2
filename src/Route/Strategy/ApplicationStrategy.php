<?php

declare(strict_types=1);

namespace MinhasHoras\Route\Strategy;

use League\Route\Route;
use League\Route\Strategy\ApplicationStrategy as LeagueApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApplicationStrategy extends LeagueApplicationStrategy
{
    protected $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function invokeRouteCallable(Route $route, ServerRequestInterface $request): ResponseInterface
    {
        $controller = $route->getCallable($this->getContainer());
        $response = $controller($this->responseFactory, $request, $route->getVars());
        $response = $this->applyDefaultResponseHeaders($response);
        return $response;
    }
}
