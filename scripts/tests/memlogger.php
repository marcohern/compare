<?php

require_once("../src/compare.php");

inc("/src/logging/MemLogger.php");

echo "MemLogger test\n";

$logger = new MemLogger();

$logger->log("Entry 1", 'TEST');
$logger->log("Entry 2", 'TEST');
$logger->log("Entry 3", 'TEST');

echo "Entries:\n";
var_dump($logger->getEntries());

echo "Clear Entries!\n";
$logger->clearEntries();
echo "Entries:\n";
var_dump($logger->getEntries());

?>