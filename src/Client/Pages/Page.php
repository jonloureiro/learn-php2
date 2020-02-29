<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use MinhasHoras\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Page
{
    abstract protected function render(): string;

    final public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse();
        $response->getBody()->write($this->render());
        return $response;
    }
}
