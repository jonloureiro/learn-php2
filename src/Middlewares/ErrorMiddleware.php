<?php

declare(strict_types=1);

namespace MinhasHoras\Middlewares;

use Throwable;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorMiddleware implements MiddlewareInterface
{
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
                $code = 501;
            }
            if ($message === "") {
                $message = "Internal Server Error";
            }
            $response = $this->responseFactory->createResponse($code, $message);
            $response->getBody()->write(
                json_encode([
                    "code" => "$code",
                    "message" => "$message"
                ])
            );
            return $response->withAddedHeader('content-type', 'application/json');
        }
    }
}
