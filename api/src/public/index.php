<?php

use MinhasHoras\Config\Locale;
use MinhasHoras\Services\Users\User;

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


echo "<br>";
$result = User::select([ 'name' => "Jonathan", 'email' => "me@jonloureiro.dev"]);
print_r($result);

echo "<br><br>FIM";
