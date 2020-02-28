<?php

declare(strict_types=1);

namespace MinhasHoras\Lib\Emitter;

use Psr\Http\Message\ResponseInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter as LaminasEmitter;

class Emitter implements EmitterInterface
{
    private $emitter;

    public function __construct()
    {
        $this->emitter = new LaminasEmitter();
    }

    public function emit(ResponseInterface $response) : bool
    {
        return $this->emitter->emit($response);
    }
}
