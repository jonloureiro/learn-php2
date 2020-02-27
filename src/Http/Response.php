<?php

namespace MinhasHoras\Http;

use MinhasHoras\Lib\Base;

class Response extends Base
{
    public function json($headers = [])
    {
        header("Content-Type: application/json; charset=UTF-8");

        foreach ($headers as $header) {
            header($header);
        }

        echo json_encode($this->values);
        http_response_code($this->code);
    }
}
