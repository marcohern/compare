<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlQueryBuilder.php");

$filters = ['id' => 1, 'gender' => 'M', 'age' => 35];
$columns = null;
$cn = new MySqlQueryBuilder();
echo $cn->select('users', $columns, $filters)."\n";


?>