<?php

namespace MinhasHoras\Services\Users;

use Exception;
use MinhasHoras\Lib\Controller;

class UsersController extends Controller
{
    public static function run($method, $request = null)
    {
        parent::run($method, $request);

        switch ($method) {
            case 'post':

                break;
            default:
                //TODO
                throw new Exception('TRATAR');
        }
    }

    private static function index(int $limit = 10, int $offset = 0)
    {
    }

    private static function show(int $id)
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
}
