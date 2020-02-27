<?php

namespace MinhasHoras\Http;

use Exception;
use MinhasHoras\Lib\Controllers;
use MinhasHoras\Lib\SingletonTrait;

class Router
{
    use SingletonTrait;
    use Controllers;

    public static function __callStatic($name, $arguments)
    {
        [$path, ] = $arguments;
        print_r($path);
        self::route($name, $path);
    }

    private static function methodExists($method)
    {
        return (
             $method === 'get'
          || $method === 'post'
          || $method === 'put'
          || $method === 'delete'
      );
    }

    private static function controllerExists(string $controller)
    {
        $controllers = self::getControllers();
        return array_key_exists($controller, $controllers);
    }

    public static function route($method, $path, $request = null)
    {
        if (!self::methodExists($method)) {
            //TODO
            throw new Exception("Método não existe");
        }

        [, $controller] = explode('/', $path);

        if (!self::controllerExists($controller)) {
            //TODO
            throw new Exception("Controller não existe");
        }

        $call = self::getControllers()[$controller];
        eval("$call::testing('$method');");
    }
}
