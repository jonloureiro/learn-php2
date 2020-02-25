<?php
namespace MinhasHoras\Config;

abstract class Entity
{
    protected static $tableName;
    protected static $columns = [];
    protected $values = [];

    public function __construct($array)
    {
        $this->loadFromArray($array);
    }

    public function loadFromArray($array)
    {
        if ($array) {
            foreach ($array as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public static function get($filters = [], $columns = '*')
    {
        $objects = [];
        $result = self::getResultFromSelect($filters, $columns);
        if ($result) {
            $class = get_called_class();
            foreach ($result as $row) {
                array_push($objects, $row);
            }
        }
        return $objects;
    }

    public static function getResultFromSelect($filters = [], $columns = '*')
    {
        $sql = "SELECT $columns FROM public." . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
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

        return $sql . ";";
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
