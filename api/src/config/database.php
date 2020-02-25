<?php
namespace Config\Database;

use PDO;
use PDOException;

class Database
{
    private static $dbh;

    public static function getDatabaseHandle()
    {
        if (assert(self::$dbh)) {
            return self::$dbh;
        }

        $envPath = realpath(dirname(__FILE__). "/../env.ini");
        $env = parse_ini_file($envPath);

        try {
            $dbh = new PDO(
                "pgsql:host={$env['host']};dbname={$env['database']}",
                $env['username'],
                $env['password'],
                [
                    PDO::ATTR_PERSISTENT => true
                ]
            );
            return $dbh;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getResultFromQuery($sql)
    {
    }

    public static function testing()
    {
        echo "testando";
    }
}
