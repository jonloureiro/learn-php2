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
                $this->set($key, $value);
            }
        }
    }

    public function get($key)
    {
        return $this->values[$key];
    }

    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }
}
