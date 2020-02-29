<?php

declare(strict_types=1);

namespace MinhasHoras\Middlewares;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Server\MiddlewareInterface as PsrMiddlewareInterface;

interface MiddlewareInterface extends PsrMiddlewareInterface
{
    public function __construct(ResponseFactoryInterface $responseFactory);
}
