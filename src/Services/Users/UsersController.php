<?php

namespace MinhasHoras\Services\Users;

use MinhasHoras\Lib\SingletonTrait;

class UsersController
{
    use SingletonTrait;

    private static function index(int $limit = 10, int $offset = 0)
    {
    }

    private static function show()
    {
    }

    private static function create()
    {
    }

    private static function update()
    {
    }

    private static function destroy()
    {
    }

    public static function testing()
    {
        echo "testando";
    }
}
