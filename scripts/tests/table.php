<?php


require_once("../src/compare.php");
inc("/src/models/Table.php");
inc("/src/database/mysql/MySqlDatabase.php");

$db = new MySqlDatabase();
$db->connect();

$tb = new Table('stores', $db);
$record = $tb->getById(2);

var_dump($record);

$db->close();
?>