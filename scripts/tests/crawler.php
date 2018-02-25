<?php


require_once("../src/compare.php");

inc("/src/crawlers/PageStateCrawler.php");
inc("/src/logging/DatabaseLogger.php");
inc("/src/database/mysql/MySqlDatabase.php");
inc("/src/crawlers/StandardColumnContainer.php");

$columns = new StandardColumnContainer();
$columns->addName('code',[
	'/^\s*Videojuego /i',
	'/\s*(para)?\s*PS4/i',
	'/\s*-\s+www\.exito\.com/i',
	'/\s*Playstation 4/i',
	'/Nintendo Switch/i',
	'/Edición Estándar/i',
	'/Edición Legendaria/i'
],[
	'/[áä]/ui' => "a",
	'/[éë]/ui' => "e",
	'/[íï]/ui' => "i",
	'/[óö]/ui' => "o",
	'/[úü]/ui' => "u",
], ' ps4');

$db = new MySqlDatabase();
$db->connect();

$logger = new DatabaseLogger($db, false);

$cr = new PageStateCrawler($columns, $logger);

$url = "https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q";
$urltpl = "$url?No=[offset]&Nrpp=[rpp]";

$exp = read("/src/expresions/exito_product_list.php");
$pageExp = '/'
	.'<p>Mostrando <strong> (\d+) - (?<rpp>\d+) de (?<total>\d+) <\/strong>resultados<\/p>'
.'/';

$cr->crawlFirstAndPlan($db, $url, $urltpl, $exp, $pageExp);

$db->close();
?>