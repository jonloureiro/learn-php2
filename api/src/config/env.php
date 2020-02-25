<?php
namespace MinhasHoras\Config;

use MinhasHoras\Lib\Singleton;

class Env extends Singleton
{
    protected static $instance;

    public static function get(string $key)
    {
        if (!empty(self::$instance)) {
            print_r(self::$instance[$key]);
            return self::$instance[$key];
        }
        $envPath = realpath(dirname(__FILE__, 3). "/env.ini");
        $env = parse_ini_file($envPath);
        self::loadFromArray($env);
        return self::$instance[$key];
    }

    private static function loadFromArray($array)
    {
        if ($array) {
            foreach ($array as $key => $value) {
                self::$instance[$key] = $value;
            }
        }
    }
}
