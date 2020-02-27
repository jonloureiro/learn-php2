<?php

use MinhasHoras\Config\Locale;
use MinhasHoras\Http\Request;
use MinhasHoras\App;
use MinhasHoras\Http\Response;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

Locale::set();

$request = new Request();

try {
    new App($request);
} catch (Throwable $e) {
    (new Response([
        "code" => $e->getCode() === 0 ? 500 : $e->getCode(),
        "message" => $e->getMessage()
    ]))->send();
}
