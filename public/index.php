<?php

use MinhasHoras\Config\Locale;
use MinhasHoras\Http\Request;
use MinhasHoras\Lib\Jwt;
use MinhasHoras\Services\Tokens\Token;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

Locale::set();

$request = new Request();
print_r($request->getBody());
print_r($_GET);


// $token = new Token([
//     'email' => "me@jonloureiro.dev",
//     'password' => "a"
// ]);

// try {
//     $user = $token->getTokenWithEmail();
//     print_r($user);
// } catch (\Throwable $th) {
//     print_r($th->getMessage());
//     echo "ERRO";
// }


// echo "<br><br>";
// $token = Jwt::sign(['name'=>"jonathan"]);
// print_r($token);
// echo "<br><br>";
// if ($result = Jwt::verify($token)) {
//     echo "Token válida";
//     print_r($result);
// }
