<?php

namespace MinhasHoras\Api\Lib;

use Exception;
use MinhasHoras\Api\Config\Env;

class Jwt
{
    use SingletonTrait;

    private static $header;

    private static function header()
    {
        if (self::$header !== null) {
            return self::$header;
        }
        self::$header = self::base64UrlEncode(
            json_encode([
                'alg' => "HS256",
                'typ' => "Jwt"
            ])
        );
        return self::$header;
    }

    private static function payload(array $data)
    {
        return self::base64UrlEncode(
            json_encode(
                array_merge(
                    [
                        'exp' => time() + 900
                    ],
                    $data
                )
            )
        );
    }

    private static function signature(string $header, string $payload)
    {
        return self::base64UrlEncode(
            hash_hmac('sha256', "$header.$payload", Env::get('secret'), true)
        );
    }

    private static function base64UrlEncode($str)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($str)
        );
    }

    public static function sign(array $data)
    {
        $header = self::header();
        $payload = self::payload($data);
        $signature = self::signature($header, $payload);
        return "$header.$payload.$signature";
    }

    public static function verify(string $token)
    {
        [$header, $payload, $signature] = explode('.', $token);
        $newSignature = self::signature($header, $payload);

        if (!hash_equals($newSignature, $signature)) {
            throw new Exception('Token inválida.');
        }

        $payload = json_decode(base64_decode($payload), true);
        $diff = intval($payload['exp']) - time();

        if ($diff < 0) {
            throw new Exception('tempo expirado');
        }

        return $payload;
    }
}
