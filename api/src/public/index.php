<?php

use MinhasHoras\Config\Locale;
use MinhasHoras\Services\Tokens\Token;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

Locale::set();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$protocol = $_SERVER['SERVER_PROTOCOL'];
$headers = getallheaders();

echo "$method $uri $protocol <br>";
foreach ($headers as $key => $header) {
    echo "$key: $header <br>";
}

$token = new Token([
    'email' => "me@jonloureiro.dev",
    'password' => "a"
]);

try {
    $user = $token->loginWithEmail();
    print_r($user);
} catch (\Throwable $th) {
    print_r($th->getMessage());
    echo "ERRO";
}


echo "<br><br>FIM";
