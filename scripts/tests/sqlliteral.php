<?php

require_once("../src/compare.php");
inc("/src/database/SqlLiteral.php");

$value1 = 123.45;
$value2 = 987612;
$value3 = "Mc'Donalds";
$value4 = new DateTime("now");
$value5 = null;
$value6 = "65342131238609";
$value7 = 0.00000000123;
$value8 = new DateTime("now");

$record = ['col1' => $value1, 'col2' => $value2, 'col3' => $value3, 'col4' => $value4 ];

$table = [
	$record,
	['col1' => $value5, 'col2' => $value6, 'col3' => $value7, 'col4' => $value8 ]
];

$sl = new  SqlLiteral();

echo $sl->getLiteral($value1)."\n";
echo $sl->getLiteral($value2)."\n";
echo $sl->getLiteral($value3)."\n";
echo $sl->getLiteral($value4)."\n";
echo $sl->getLiteral($value5)."\n";
echo $sl->getLiteral($value6)."\n";


echo $sl->getLiteralList($record)."\n";
echo $sl->getLiteralTable($table)."\n";

?>