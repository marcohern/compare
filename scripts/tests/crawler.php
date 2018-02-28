<?php


require_once("../src/compare.php");

inc("/src/crawlers/Crawler.php");
inc("/src/logging/DatabaseLogger.php");
inc("/src/logging/CmdLogger.php");
inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/crawlers/StandardColumnContainer.php");


$db = new MySqlDatabase();
$db->connect();

$logger = new CmdLogger();

$cr = new Crawler($logger);

$url = "http://www.homecenter.com.co/homecenter-co/category/cat930005/Videojuegos/N-1yv6d84";
 $urltpl = $url."?No=[offset]&Nrpp=[rpp]";

$exp = read("/src/expresions/homecenter_product_list.php");

$items = $cr->crawl($url, $exp);
var_dump($items);
$db->close();
?>