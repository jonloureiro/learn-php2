<?php

namespace MinhasHoras\Config;

use MinhasHoras\Lib\SingletonTrait;
use PDO;
use PDOException;

class Database
{
    use SingletonTrait;

    protected static $instance;

    public static function getDatabaseHandle()
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        try {
            self::$instance = new PDO(
                "pgsql:host=" . Env::get('host') .
                ";dbname=" . Env::get('database'),
                Env::get('username'),
                Env::get('password'),
                [
                    PDO::ATTR_PERSISTENT => true
                ]
            );
            return self::$instance;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getResultFromQuery($sql, int $limit = null, int $offset = null)
    {
        if ($limit) {
            $sql .= " LIMIT $limit";
            if ($offset) {
                $sql .= " OFFSET $offset";
            }
            $sql .= ";";
        }
        $instance = self::getDatabaseHandle();
        $sth = $instance->prepare($sql);
        if ($sth->execute()) {
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        echo 'CONFIG/DATABASE.PHP: TRATAR ERRO;';
    }
}
