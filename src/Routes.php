<?php

declare(strict_types=1);

namespace MinhasHoras;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use MinhasHoras\Lib\Route\RouterInterface;

class Routes
{
    private $router;
    private $responseFactory;

    public function __construct(
        RouterInterface $router,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->router = $router;
        $this->responseFactory = $responseFactory;
        $this->setRoutes();
    }

    private function setRoutes(): void
    {
        $this->router->map('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
            $response = $this->responseFactory->createResponse(200, 'hello world');
            $response->getBody()->write('<h1>Hello, World!</h1>');
            return $response;
        });
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }
}
