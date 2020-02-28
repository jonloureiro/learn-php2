<?php

declare(strict_types=1);

namespace MinhasHoras\Lib\Emitter;

use Psr\Http\Message\ResponseInterface;

interface EmitterInterface
{
    public function emit(ResponseInterface $response) : bool;
}
