<?php

declare(strict_types=1);

namespace MinhasHoras\Lib\Route;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use League\Route\Route;

interface RouterInterface
{
    public function dispatch(RequestInterface $request): ResponseInterface;
    public function map(string $method, string $path, $handler): Route;
}
