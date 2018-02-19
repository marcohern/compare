<?php

require_once("src/executors/ExitoVgPs4Executor.php");

$executor = new ExitoVgPs4Executor();
$executor->run();
$executor->csv();

?>