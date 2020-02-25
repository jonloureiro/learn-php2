<?php
require_once(dirname(__FILE__, 2) . "/src/config/database.php");

use function \Config\Database\getDatabaseHandle;

$dbh = getDatabaseHandle();

echo "FIM";
