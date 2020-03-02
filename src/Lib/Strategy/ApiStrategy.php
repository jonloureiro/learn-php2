<?php

declare(strict_types=1);

namespace App\Lib\Strategy;

use League\Route\Route;
use League\Route\Strategy\JsonStrategy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiStrategy extends JsonStrategy
{
    public function invokeRouteCallable(
        Route $route,
        ServerRequestInterface $request
    ): ResponseInterface {
        $controller = $route->getCallable($this->getContainer());
        $response = $controller($this->responseFactory, $request, $route->getVars());
        $response = $this->applyDefaultResponseHeaders($response);
        return $response;
    }
}
