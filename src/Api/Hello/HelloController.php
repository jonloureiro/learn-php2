<?php

declare(strict_types=1);

namespace App\Api\Hello;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HelloController
{
    public function world(ResponseFactoryInterface $responseFactory, ServerRequestInterface $request) : ResponseInterface
    {
        $response = $responseFactory->createResponse();
        $response->getBody()->write(
            json_encode([
              "hello" => "world"
          ])
        );
        return $response->withStatus(202);
    }
}
