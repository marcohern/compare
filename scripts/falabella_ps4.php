<?php

require_once("src/executors/FalabellaVgPs4Executor.php");

$executor = new FalabellaVgPs4Executor();
$executor->run();
$executor->csv();

?>