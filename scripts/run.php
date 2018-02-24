<?php

require_once("src/compare.php");
require_once("src/Logger.php");
require_once("src/Database.php");
require_once("src/storage/ImportProduct.php");
require_once("src/executors/KtronixVgPs4Executor.php");
require_once("src/executors/ExitoVgPs4Executor.php");
require_once("src/executors/FalabellaVgPs4Executor.php");
require_once("src/executors/AlkostoVgPs4Executor.php");

$db = new Database();
$db->connect();

$p = new ImportProduct($db);
$p->getProcessId();

$executor = new KtronixVgPs4Executor();
$executor->run();

$data = $executor->getItems();
$p->save('prd_ktronix', $data);

$executor = new ExitoVgPs4Executor();
$executor->run();

$data = $executor->getItems();
$p->save('prd_exito', $data);

$executor = new FalabellaVgPs4Executor();
$executor->run();

$data = $executor->getItems();
$p->save('prd_falabella', $data);

$executor = new AlkostoVgPs4Executor();
$executor->run();

$data = $executor->getItems();
$p->save('prd_alkosto', $data);

?>