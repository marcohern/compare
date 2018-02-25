<?php


require_once("../src/compare.php");

inc("/src/crawlers/ProcesorCrawler.php");
inc("/src/logging/DatabaseLogger.php");
inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/StandardColumnContainer.php");

$columns = new StandardColumnContainer();
$columns->addSimple('id');
$columns->addName('code',[
	'/^\s*Videojuego (PS4 )?/i',
	'/Edition PS4$/',
	'/PS4$/',
	'/â/',
	'/ Estandard/i',
	'/ Estandar/i',
],[
	'/WW II/i' => "WWII",
	'/Edicion Legado/i' => "Legacy Edition",
	'/Ratchet y Clank/i' => "Ratchet & Clank",
	'/\W+Remasterizado/i' => " Remastered",
	'/thief.s/i' => "Thief's",
	'/Tortugas Ninja in/i' => "Teenage Mutant Ninja Turtles: Mutants in"
], ' ps4');
$columns->addSimple('price');
$columns->addSimple('brand');
$columns->addEscape('category');
$columns->addEscape('url');

$db = new MySqlDatabase();
$db->connect();

$logger = new DatabaseLogger($db, false);

$cr = new ProcesorCrawler($columns, $logger);

$url = "http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";

$exp = read("/src/expresions/ktronix_product_list.php");

$cr->crawl($url, $exp);

$db->close();
?>