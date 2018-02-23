<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlOrderBy.php");

$orderby = ['name','code' => 'DESC', 'age' => 'ASC'];
$none = null;
$or = new MySqlOrderBy();

echo "ORDER BY ".$or->getOrderBy($orderby)."\n";
echo "ORDER BY [".$or->getOrderBy($none)."]\n";

?>