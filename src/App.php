<?php

namespace MinhasHoras;

use Exception;
use MinhasHoras\Http\RequestInterface;
use MinhasHoras\Http\Router;
use MinhasHoras\Lib\Base;

class App extends Base
{
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;

        $isApi = substr($request->uri, 0, 5) === "/api/";
        $endpoint = substr($request->uri, 4);

        if ($isApi) {
            Router::route(
                $request->method,
                $endpoint,
                $request,
            );
        } elseif ($request->method === 'get') {
            //TODO: MANDAR PARA VER SE É DO CLIENT
        } else {
            // TODO: ORGANIZAR EXCEPTION
            throw new Exception();
        }
    }
}
