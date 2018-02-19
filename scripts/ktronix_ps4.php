<?php

require_once("src/executors/KtronixVgPs4Executor.php");

$executor = new KtronixVgPs4Executor();
$executor->run();
$executor->csv();

?>