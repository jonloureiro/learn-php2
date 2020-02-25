<?php
require_once(dirname(__FILE__, 2) . "/src/config/database.php");

use \Config\Database\Database;

Database::testing();

echo "FIM";
