<?php

use MinhasHoras\Config\Database;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

Database::testing();

echo "FIM";
