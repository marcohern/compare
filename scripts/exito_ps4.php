<?php

require_once("src/Logger.php");
require_once("src/Database.php");
require_once("src/storage/ImportProduct.php");
require_once("src/executors/ExitoVgPs4Executor.php");

$db = new Database();
$db->connect();
$p = new ImportProduct($db);
$p->getProcessId();

$executor = new ExitoVgPs4Executor();
$executor->run();
$data = $executor->getItems();

$p->save('prd_exito', $data);

?>