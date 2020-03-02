<?php

declare(strict_types=1);

namespace App\Lib\Strategy;

use League\Plates\Engine;
use League\Route\Http\Exception as HttpException;
use League\Route\Route;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

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

    protected function throwThrowableMiddleware(Throwable $error): MiddlewareInterface
    {
        return new class($this->responseFactory->createResponse(), $this->templates, $error) implements MiddlewareInterface {
            protected $response;
            protected $error;
            protected $templates;

            public function __construct(ResponseInterface $response, Engine $templates, HttpException $error)
            {
                $this->response = $response;
                $this->templates = $templates;
                $this->error = $error;
            }

            public function process(
                ServerRequestInterface $request,
                RequestHandlerInterface $requestHandler
            ): ResponseInterface {
                $response = $this->response;
                if ($response->getBody()->isWritable()) {
                    $response->getBody()->write(
                        $this->templates->render('Error', [
                            "code" => $this->error->getStatusCode(),
                            "message" => $this->error->getMessage(),
                            "text" => $this->error->getTraceAsString()
                        ])
                    );
                }
                return $response;
            }
        };
    }

    public function getThrowableHandler(): MiddlewareInterface
    {
        return new class($this->responseFactory->createResponse(), $this->templates) implements MiddlewareInterface {
            protected $response;
            protected $templates;

            public function __construct(ResponseInterface $response, Engine $templates)
            {
                $this->response = $response;
                $this->templates = $templates;
            }

            public function process(
                ServerRequestInterface $request,
                RequestHandlerInterface $requestHandler
            ): ResponseInterface {
                try {
                    return $requestHandler->handle($request);
                } catch (Throwable $e) {
                    $statusCode = 500;
                    if ($e->getCode()) {
                        $statusCode = $e->getCode();
                    }
                    $response = $this->response;
                    if ($response->getBody()->isWritable()) {
                        $response->getBody()->write(
                            $this->templates->render('Error', [
                              "code" => $statusCode,
                              "message" => $e->getMessage(),
                              "text" => $e->getTraceAsString()
                           ])
                        );
                    }
                    return $response;
                }
            }
        };
    }
}
