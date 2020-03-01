<?php

declare(strict_types=1);

namespace MinhasHoras\Client\Pages;

use MinhasHoras\Http\TemplateEngineInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Page
{
    abstract protected function render(TemplateEngineInterface $templateEngine, ServerRequestInterface $request): string;

    final public function __invoke(
        TemplateEngineInterface $templateEngine,
        ResponseFactoryInterface $responseFactory,
        ServerRequestInterface $request
    ) : ResponseInterface {
        $response = $responseFactory->createResponse();
        $response->getBody()->write($this->render($templateEngine, $request));
        return $response;
    }
}
