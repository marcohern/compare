<?php

require_once("src/executors/AlkostoVgPs4Executor.php");

$executor = new AlkostoVgPs4Executor();
$executor->run();
$executor->csv();

?>