<?php
namespace MinhasHoras\Lib;

abstract class Singleton
{
    protected static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
