<?php
namespace Config\Database;

use PDO;
use PDOException;

function getDatabaseHandle()
{
    $envPath = realpath(dirname(__FILE__). "/../env.ini");
    $env = parse_ini_file($envPath);

    try {
        $dbh = new PDO(
            "pgsql:host={$env['host']};dbname={$env['database']}",
            $env['username'],
            $env['password']
        );
        return $dbh;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
