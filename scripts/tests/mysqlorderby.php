<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlOrderBy.php");

$orderby = ['name','code' => 'DESC', 'age' => 'ASC'];
$or = new MySqlOrderBy();

echo $or->getOrderBy($orderby)."\n";

?>