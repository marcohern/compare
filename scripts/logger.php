<?php

require_once("src/Logger.php");
require_once("src/Database.php");
require_once("src/storage/ImportProduct.php");
require_once("src/executors/KtronixVgPs4Executor.php");


$db = new Database();
$db->connect();

$row = $db->selectSingle('stores',['code' => 'FLB']);
$p = new ImportProduct($db);


$executor = new KtronixVgPs4Executor();
$executor->run();
//$executor->csv();

$data = $executor->getItems();
$p->save('prd_ktronix', $data);
?>