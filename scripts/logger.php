<?php

require_once("src/Logger.php");
require_once("src/Database.php");

$logger = new Logger();

$logger->log("Hello");
$logger->log("How");
$logger->log("Are");
$logger->log("You?");

$logger->entryStart("This is a timed entry");
sleep(2);
$logger->entryEnd();

$logger->output();

$record1 = ['code' => 'STR1', 'name' => 'Store X1', 'country' => 'CO', 'url' => 'http://www.storex1.com', 'created' => date("Y-m-d H:i:s")];
$filters = ['id' => 100];
$data = [
	$record1
];


$db = new Database();

echo $db->getUpateStmt('stores',$record1,$filters);

?>