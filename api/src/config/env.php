<?php
namespace MinhasHoras\Config;

class Env
{
    protected static $values = [];

    public static function get($key)
    {
        if (!empty(self::$values)) {
            return self::$values[$key];
        }
        $envPath = realpath(dirname(__FILE__, 3). "/env.ini");
        $env = parse_ini_file($envPath);
        self::loadFromArray($env);
        return self::$values[$key];
    }

    private static function loadFromArray($array)
    {
        if ($array) {
            foreach ($array as $key => $value) {
                self::$values[$key] = $value;
            }
        }
    }
}
