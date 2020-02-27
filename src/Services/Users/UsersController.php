<?php

namespace MinhasHoras\Services\Users;

use Exception;
use MinhasHoras\Http\Response;
use MinhasHoras\Lib\Controller;

class UsersController extends Controller
{
    public static function run($method, $request = null)
    {
        parent::run($method, $request);
        switch ($method) {
            case 'post':
                self::create();
                break;
            default:
                //TODO
                throw new Exception('TRATAR', 501);
        }
    }

    private static function create()
    {
        (new Response([
            "message" => "Ainda não implementei",
            "code" => "501"
        ]))->json();
    }
}
