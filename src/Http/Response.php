<?php

namespace MinhasHoras\Http;

use MinhasHoras\Lib\Base;

class Response extends Base
{
    public function send()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($this->values);
        http_response_code($this->code);
    }
}
