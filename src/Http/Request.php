<?php

namespace MinhasHoras\Http;

use MinhasHoras\Lib\Base;

class Request extends Base implements RequestInterface
{
    public function __construct()
    {
        parent::loadFromArray([
          "method" => strtolower($_SERVER['REQUEST_METHOD']),
          "uri" => strtolower($_SERVER['REQUEST_URI']),
          "headers" => $this->getAllHeaders(),
          // "body" => "",
        ]);
    }

    private function getAllHeaders()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $headers[strtolower(
                    str_replace('_', '-', substr($key, 5))
                )] = $value;
            }
        }
        return $headers;
    }

    public function getBody()
    {
        if ($this->method != 'post' && $this->method != 'put') {
            return;
        }
        if (!empty($this->body)) {
            return $this->body;
        }
        $this->body = json_decode(
            file_get_contents('php://input'),
            true
        );

        return $this->body;
    }
}
