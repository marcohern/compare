<?php

require_once("../src/compare.php");

inc("/src/logging/Logger.php");

$logger = new Logger();

echo "Normal Entry:";
$entry = $logger->log("This is a normal entry", 'TEST');
var_dump($entry);

echo "Duration entry:";
$logger->start("This is a duration entry", 'TEST');
sleep(1);
$entry = $logger->end();
var_dump($entry);

?>