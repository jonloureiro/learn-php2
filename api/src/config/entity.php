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

    public static function select($filters = [], $columns = '*')
    {
        $sql = "SELECT $columns FROM public." . static::$tableName
            . static::getFilters($filters);
        return $sql;
    }

    private static function getFilters($filters)
    {
        $sql = '';

        if (count($filters)) {
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
