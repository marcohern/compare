<?php

require_once("../src/compare.php");
inc("/src/database/mysql/MySqlDatabase.php");

$db = new MySqlDatabase();

$db->connect();
echo $db->version()."\n";

//var_dump($db->select('stores'));

$r = $db->insert('stores', ['id'=>7, 'code' => 'XXX', 'name' => 'XXX Store', 'country' => 'US', 'url' => 'http://xxxstore.com', 'created' => new Datetime("now"), 'updated' => null]);

var_dump($r);

$db->close();
?>