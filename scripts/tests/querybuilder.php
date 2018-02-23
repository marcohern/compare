<?php

require_once("../src/compare.php");

inc("/src/database/SqlQueryBuilder.php");
inc("/src/models/Entity.php");

$qb = new SqlQueryBuilder();

$dt = new DateTime("now");
$id = 1;
$name = "Mc'Donalds";

$arr1 = ['id' => $id, 'name'=>$name, 'date' => $dt];
$arr2 = ['id' => 2, 'name'=>"Marco", 'date' => $dt];
$data = [$arr1,$arr2];
$cols = ['id' => 'IDNUmber+1','name','date'];

echo $qb->select("theTable", ['id' => 1],['a','b','c'],['a' => 'DESC','c'])."\n";
echo $qb->insert("theTable2",$arr1)."\n";
echo $qb->insert("theTable2",$data)."\n";
echo $qb->delete("users",['username' => 'john'])."\n";
echo $qb->update("users",$arr1,['username' => 'john'])."\n";

$obj = new Entity();
$obj->xxx = 1;
var_dump($obj, Entity::class);
?>