<?php

use MinhasHoras\Config\Database;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

$sql = "SELECT * FROM public.user;";

$result = Database::getResultFromQuery($sql);

print_r($result);

echo "FIM";
