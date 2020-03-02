<?php

declare(strict_types=1);

namespace App\Client\Login;

use League\Plates\Engine;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginPage
{
    public function __invoke(
        Engine $templates,
        ResponseFactoryInterface $responseFactory,
        ServerRequestInterface $request
    ) : ResponseInterface {
        $response = $responseFactory->createResponse();
        $response->getBody()->write(
            $templates->render('Login', ['name' => 'Jonathan'])
        );
        return $response;
    }
}
