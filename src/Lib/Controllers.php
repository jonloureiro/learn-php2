<?php

namespace MinhasHoras\Lib;

trait Controllers
{
    private static $controllers;

    protected static function getControllers()
    {
        if (!empty(self::$controllers)) {
            return self::$controllers;
        }

        $controllers = [];
        $services = array_diff(
            scandir(dirname(__FILE__, 2) . "/Services"),
            [ ".", "..", ".DS_Store"]
        );
        foreach ($services as $service) {
            $controllers[strtolower($service)] =
                "\MinhasHoras\Services\\$service\\${service}Controller";
        }

        self::$controllers = $controllers;
        return self::$controllers;
    }
}
