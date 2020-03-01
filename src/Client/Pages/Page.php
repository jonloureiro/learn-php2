<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Page
{
    abstract protected function render(): string;

    final public function __invoke(ResponseFactoryInterface $responseFactory, ServerRequestInterface $request) : ResponseInterface
    {
        $response = $responseFactory->createResponse();
        $response->getBody()->write($this->render());
        return $response;
    }
}
