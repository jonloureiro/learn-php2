<?php
namespace MinhasHoras\Config;

use PDO;
use PDOException;

class Database
{
    private static $dbh;

    public static function getDatabaseHandle()
    {
        if (self::$dbh !== null) {
            return self::$dbh;
        }

        $envPath = realpath(dirname(__FILE__, 3). "/env.ini");
        $env = parse_ini_file($envPath);

        try {
            self::$dbh = new PDO(
                "pgsql:host={$env['host']};dbname={$env['database']}",
                $env['username'],
                $env['password'],
                [
                    PDO::ATTR_PERSISTENT => true
                ]
            );
            return self::$dbh;
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
        $dbh = self::getDatabaseHandle();
        $sth = $dbh->prepare($sql);
        if ($sth->execute()) {
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        echo 'CONFIG/DATABASE.PHP: TRATAR ERRO;';
    }

    public static function testing()
    {
        echo "testando";
    }
}
