<?php


require_once("../src/compare.php");
inc("/src/models/StoresTable.php");
inc("/src/database/mysql/MySqlDatabase.php");

$db = new MySqlDatabase();
$db->connect();

$st = new StoresTable($db);

$record = $st->getById(1);

var_dump($record);

$data = $st->find(['country' => 'CO']);

var_dump($data);

$db->close();
?>