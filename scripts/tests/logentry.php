<?php

require_once("../src/compare.php");

inc("/src/logging/LogEntry.php");

$e = new LogEntry();

$e->id = 1;
$e->message = 'The Message';
$e->created = '2019-01-01 12:00:00';
$e->updated = date("Y-m-d H:i:s");

var_dump(get_object_vars($e));

?>