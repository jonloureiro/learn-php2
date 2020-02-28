<?php

namespace MinhasHoras\Services\Tokens;

use Exception;
use MinhasHoras\Http\Response;
use MinhasHoras\Lib\Controller;

class TokensController extends Controller
{
    public static function run($method, $request = null)
    {
        parent::run($method, $request);
        switch ($method) {
            case "post":
                self::create();
                break;
            default:
                //TODO
                throw new Exception('TRATAR', 501);
        }
    }

    private static function create()
    {
        $request = self::getRequest();
        $body = $request->getBody();

        if (!($body && $body['email'] && $body['password'])) {
            throw new Exception("Error Processing Request", 401);
        }

        [$user, $token] = (new Token($body))->getTokenWithEmail();

        $response = new Response([
            "message" => $user->getValues(),
            "code" => "200"
        ]);
        $response->json([
          "Set-Cookie: token=$token"
        ]);
    }
}
