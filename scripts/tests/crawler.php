<?php


require_once("../src/compare.php");

inc("/src/crawlers/PlanCrawler.php");
inc("/src/logging/DatabaseLogger.php");
inc("/src/logging/CmdLogger.php");
inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/crawlers/StandardColumnContainer.php");

$columns = new StandardColumnContainer();
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
$columns->addEscape('category');
$columns->addEscape('url');

$db = new MySqlDatabase();
$db->connect();

$logger = new CmdLogger();

$cr = new PlanCrawler($db, $columns, $logger);

$url = "http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
 		$urltpl = $url."?p=[p1]";
$file = ROOT."/html/exito_ps4_games.html";

$exp = read("/src/expresions/ktronix_product_list.php");
$pageExp = '/'
	.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
.'/';


//$cr->crawlFirstAndPlan($url, $urltpl, $exp, $pageExp);

$cr->crawlPlan($exp);

$db->close();
?>