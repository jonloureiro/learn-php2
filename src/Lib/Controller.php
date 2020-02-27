<?php

namespace MinhasHoras\Lib;

use MinhasHoras\Http\Request;

abstract class Controller
{
    use SingletonTrait;

    private static $request;

    public static function run($method, $request = null)
    {
        if (empty(self::$request)) {
            if ($request === null) {
                self::$request();
            } else {
                self::$request = $request;
            }
        }
    }

    protected static function getRequest()
    {
        if (!empty(self::$request)) {
            return self::$request;
        }
        self::$request = new Request();
        return self::$request;
    }
}
