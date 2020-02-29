<?php

declare(strict_types=1);

namespace MinhasHoras\Http;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\ServerRequestFactory as LaminasServerRequestFactory;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    private $serverRequestFactory;

    public function __construct()
    {
        $this->serverRequestFactory = new LaminasServerRequestFactory();
    }

    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        return $this->serverRequestFactory->createServerRequest($method, $uri, $serverParams);
    }

    public function fromGlobals(
        array $server = null,
        array $query = null,
        array $body = null,
        array $cookies = null,
        array $files = null
    ) : ServerRequestInterface {
        return $this->serverRequestFactory::fromGlobals($server, $query, $body, $cookies, $files);
    }
}
