<?php

use MinhasHoras\Config\Locale;
use MinhasHoras\Http\Request;
use MinhasHoras\App;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 2) . "/vendor/autoload.php";

Locale::set();

new App(new Request);
echo "<br>Sucess";
