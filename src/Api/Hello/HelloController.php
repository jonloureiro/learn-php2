<?php

declare(strict_types=1);

namespace MinhasHoras\Api\Hello;

use MinhasHoras\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HelloController
{
    public function world(ServerRequestInterface $request) : ResponseInterface
    {
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse();
        $response->getBody()->write(
            json_encode([
              "hello" => "world"
          ])
        );
        return $response->withStatus(202);
    }
}
