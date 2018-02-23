<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlFilters.php");

$columns = ['id' => 1, 'gender' => 'M', 'age' => 35];
$cn = new MySqlFilters();
echo $cn->getFilters($columns)."\n";


?>