<?php
namespace MinhasHoras\Api\Config;

use MinhasHoras\Api\Lib\SingletonTrait;

class Env
{
    use SingletonTrait;

    protected static $instance;

    public static function get(string $key)
    {
        if (!empty(self::$instance)) {
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
