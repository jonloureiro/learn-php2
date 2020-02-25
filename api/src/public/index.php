<?php

use function MinhasHoras\Config\Database\testing;

ini_set('display_errors', 1);

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

testing();

echo "FIM";
