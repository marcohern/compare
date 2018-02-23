<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlQueryBuilder.php");

$filters = ['id' => 1, 'gender' => 'M', 'age' => 35];
$columns = null;
$order = ['id'];
$cn = new MySqlQueryBuilder();
echo $cn->select('users', $columns, $filters, $order)."\n";
echo $cn->insert('users', $filters)."\n";
echo $cn->update('users', $filters, $filters)."\n";
echo $cn->delete('users', $filters)."\n";


?>