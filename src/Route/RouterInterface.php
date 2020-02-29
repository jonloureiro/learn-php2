<?php

declare(strict_types=1);

namespace MinhasHoras\Route;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Route as LeagueRoute;

interface RouterInterface
{
    public function dispatch(ServerRequestInterface $request): ResponseInterface;
    public function add(string $method, string $path, $handler): LeagueRoute;
}
