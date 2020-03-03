<?php

declare(strict_types=1);

namespace App\Api\Hello;

class HelloController
{
    public function world() : array
    {
        return [
            'code' => 202,
            'body' => [
                'hello' => getenv('HOST')
            ]
        ];
    }
}
