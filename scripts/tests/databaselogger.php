<?php

require_once("../src/compare.php");

inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/logging/DatabaseLogger.php");

echo "DatabaseLogger test\n";

$db = new MySqlDatabase();
$db->connect();

$logger = new DatabaseLogger($db);

$logger->start('Duration Entry 1', 'TEST');

var_dump($logger->log("Entry 1", 'TEST'));

$logger->start('Duration Entry 2', 'TEST');

var_dump($logger->log("Entry 2", 'TEST'));

var_dump($logger->end());

var_dump($logger->log("Entry 3", 'TEST'));

var_dump($logger->end());

?>