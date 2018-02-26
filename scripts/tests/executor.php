<?php
require_once("../src/compare.php");

inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/logging/CmdLogger.php");
inc("/src/executors/Executor.php");
inc("/src/storage/CampaignsTable.php");


$db = new MySqlDatabase();
$db->connect();
$logger = new CmdLogger();
$cmps = new CampaignsTable($db);


$campaign = $cmps->first(['code' => 'FLB-PS4-GAMES']);

$class = $campaign->executor;
inc("/src/executors/$class.php");
$exe = new $class($db, $logger);
$exe->init($campaign);
$exe->run();

$db->close();

?>