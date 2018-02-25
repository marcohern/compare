<?php


require_once("../src/compare.php");

inc("/src/crawlers/Crawler.php");

$cr = new Crawler();

$url = "http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";

$exp = read("/src/expresions/ktronix_product_list.php");

var_dump($cr->crawl($url, $exp));

?>