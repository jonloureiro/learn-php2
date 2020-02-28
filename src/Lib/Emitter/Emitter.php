<?php

declare(strict_types=1);

namespace MinhasHoras\Lib\Emitter;

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;

class Emitter implements EmitterInterface
{
    private $emitter;

    public function __construct()
    {
        $this->emitter = new SapiEmitter();
    }

    public function emit(ResponseInterface $response) : bool
    {
        return $this->emitter->emit($response);
    }
}
