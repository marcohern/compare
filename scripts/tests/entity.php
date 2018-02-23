<?php

require_once("../src/compare.php");

inc("/src/models/Entity.php");

$e = new Entity();

$e->id = 1;
$e->created = '2019-01-01 12:00:00';
$e->updated = '2019-01-01 12:00:00';

var_dump(get_object_vars($e));
?>