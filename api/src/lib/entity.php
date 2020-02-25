<?php
namespace MinhasHoras\Lib;

use MinhasHoras\Config\Database;

abstract class Entity extends Base
{
    protected static $tableName;
    protected static $columns = [];

    public static function get($filters = [], $columns = '*', int $limit = null, int $offset = null)
    {
        $objects = [];
        $result = self::getResultFromSelect($filters, $columns, $limit, $offset);
        if ($result) {
            $class = get_called_class();
            foreach ($result as $key => $row) {
                array_push($objects, new $class($row));
            }
        }
        if ($limit === 1) {
            return $objects[0];
        }
        return $objects;
    }

    public static function getResultFromSelect($filters = [], $columns = '*', int $limit = null, int $offset = null)
    {
        $sql = "SELECT $columns FROM public." . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql, $limit, $offset);
        if (empty($result)) {
            return null;
        }
        return $result;
    }

    private static function getFilters($filters)
    {
        $sql = '';

        if (!empty($filters)) {
            $sql = " WHERE 1 = 1";
            foreach ($filters as $key => $value) {
                $sql .= " AND $key = " . static::getFormattedValue($value);
            }
        }

        return $sql;
    }

    private static function getFormattedValue($value)
    {
        if (is_null($value)) {
            return 'null';
        }
        if (gettype($value) === 'string') {
            return "'$value'";
        }
        return $value;
    }
}
