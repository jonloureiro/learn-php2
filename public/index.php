<?php

ini_set("display_errors", 1);

declare(strict_types=1);

use MinhasHoras\App;
use MinhasHoras\Http\Emitter;
use MinhasHoras\Http\ResponseFactory;
use MinhasHoras\Http\ServerRequestFactory;
use MinhasHoras\Route\Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

// $serverRequestFactory = new ServerRequestFactory();
// $router = new Router(new ResponseFactory());

// $router->api('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
//     $responseFactory = new ResponseFactory();
//     $response = $responseFactory->createResponse();
//     $response->getBody()->write(
//         json_encode([
//             "test" => "test"
//         ])
//     );
//     return $response->withStatus(200);
// });

// $emitter = new Emitter();

// new App($serverRequestFactory, $router, $emitter);
