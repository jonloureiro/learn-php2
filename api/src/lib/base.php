<?php
namespace MinhasHoras\Api\Lib;

abstract class Base
{
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
}
