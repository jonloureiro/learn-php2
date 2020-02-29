<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    private $router;
    private $api;
    public function dispatch(ServerRequestInterface $request): ResponseInterface;
    public function api(string $method, string $path, $handler): void;
}
