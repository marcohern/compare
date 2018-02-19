<?php
require_once('functions.php');

$page_start = 1;
$url = "http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
$urltpl = "$url?p=[p1]";
$pgrexp = '/'
	.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
.'/';

$exp = '/'
	.'var item(?<num>\d+) = \{'
		.'"name":"(?<name>[^"]+)",'
		.'"id":"(?<id>\d+)",'
		.'"price":"(?<price>\d+)",'
		.'"brand":"(?<brand>[^"]+)",'
		.'"category":"(?<category>[^"]+)",'
		.'"url":"(?<url>[^"]+)"\};\s*'
.'/';
$remove = ['name' => ['/^Videojuego (PS4 )?/','/ Estandard$/','/\\t/','/ PS4$/']];
$cols = ['id','name','price','brand','category','url','num'];
$norm = ['name'];
$escape = ['category','url'];
$p = 1;
echo "KTronix - PS4 Videogames\n";
echo "Reading content...\n";
$products = [];
$prds = read_page($url, $exp, $cols, $norm, $remove, $escape);
$products = array_merge($products, $prds);
while ($p < 2) {
	$p++;
	$prds = read_page($urltpl, $exp, $cols, $norm, $remove, $escape,0,0,0,$p);
	$products = array_merge($products, $prds);
}
var_dump($products);
?>