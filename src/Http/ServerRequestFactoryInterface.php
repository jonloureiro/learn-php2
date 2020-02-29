<?php

declare(strict_types=1);

namespace MinhasHoras\Http;

use Psr\Http\Message\ServerRequestFactoryInterface as PsrServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestFactoryInterface extends PsrServerRequestFactoryInterface
{
    public function fromGlobals(
        array $server = null,
        array $query = null,
        array $body = null,
        array $cookies = null,
        array $files = null
    ) : ServerRequestInterface;
}
