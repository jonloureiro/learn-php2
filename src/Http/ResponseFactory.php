<?php

declare(strict_types=1);

namespace MinhasHoras\Http;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;

class ResponseFactory implements ResponseFactoryInterface
{
    private $responseFactory;

    public function __construct()
    {
        $this->responseFactory = new LaminasResponseFactory();
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->responseFactory->createResponse($code, $reasonPhrase);
    }
}
