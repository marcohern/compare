<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlDatabase.php");

$db = new MySqlDatabase();

$db->connect();
echo $db->version();

var_dump($db->select('stores'));

$db->close();
?>