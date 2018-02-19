<?php

require_once("src/Crawler.php");

//$url='http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juego-playstation-3';
//$url = "http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
//$url = "http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";

$url = "http://www.ktronix.com/videojuegos/mundo-xbox/xbox-one/xbox-one-videojuegos";
$urltpl = "$url?p=[p1]";
$pagerExp = '/'
	.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
.'/';

$itemExp = '/'
	.'\'name\': \'(?<name>[^\']+)\',\s*'
	.'\'id\': \'(?<id>[^\']+)\',\s*'
	.'\'price\': \'(?<price>[^\']+)\',\s*'
	.'\'brand\': \'(?<brand>[^\']+)\',\s*'
	.'\'category\': \'(?<category>[^\']+)\',\s*'
	.'\'variant\': \'(?<variant>[^\']*)\',\s*'
	.'\'list\': \'(?<url>[^\']+)\',\s*'
.'/';

$stdcc = new StandardColumnContainer();
$stdcc->addSimple('id');
$stdcc->addName('name',[
	'/^\s*Videojuego (PS[43] |XBOX ONE (X )?)?/i',
	'/Edition PS[43]$/',
	'/ XBOX ONE/',
	'/â/',
	'/ Estandard/i',
	'/ Estandar/i'
]);
$stdcc->addSimple('price');
$stdcc->addSimple('brand');
$stdcc->addEscape('category');

$crawler= new Crawler($stdcc, $itemExp, $pagerExp);
$table = [];

$crawler->crawlFirst($url, $table);
do {} while($crawler->crawlNext($urltpl, $table));

var_dump($table);

?>