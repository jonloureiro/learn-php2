<?php

namespace MinhasHoras\Middlewares;

use Throwable;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorMiddleware implements MiddlewareInterface
{
    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $t) {
            $code = $t->getCode();
            $message = $t->getMessage();

            if ($code === 0) {
                $code = 500;
            }
            if ($message === "") {
                $message = "Internal Server Error";
            }

            return $this->responseFactory->createResponse($code, $message);
        }
    }
}
