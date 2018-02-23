<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlColumnName.php");

$column = 'name';
$exp = '1+2+3';
$aliases = ['name','code' => '1+2', 'age', 'date'];
$cn = new MySqlColumnName();
echo $cn->getColumnName($column)."\n";
echo $cn->getColumnName($exp,$column)."\n";

echo $cn->getColumnAliasList($aliases)."\n";

?>