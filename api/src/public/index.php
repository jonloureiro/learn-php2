<?php

use MinhasHoras\Config\Database;
use MinhasHoras\Config\Locale;
use MinhasHoras\Services\Users\User;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

Locale::set();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$protocol = $_SERVER['SERVER_PROTOCOL'];
$headers = getallheaders();

echo "$method $uri $protocol <br/>";
foreach ($headers as $key => $header) {
    echo "$key: $header <br/>";
}

$sql = "SELECT * FROM public.user;";


$result = Database::getResultFromQuery($sql);
print_r($result);

$usr = new User([ 'name' => "jonathan loureiro", 'password' => '123']);
$usr->name = "jonathan 2";
echo $usr->name;

echo "FIM";
