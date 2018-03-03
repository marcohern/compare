<?php
require_once('../src/compare.php');

inc('/src/http/HttpHeader.php');
inc('/src/crawlers/Crawler.php');
inc('/src/util/Stringer.php');

$h = new HttpHeader();
$h->readFromConfig();
echo "$h\n";

$urls = [
	'https://www.google.com.co/?gfe_rd=cr&dcr=0&ei=sLaaWrroKpGeX9igu9gD',
	'https://www.google.com.co/maps/place/Belen+Almeria/@6.2439684,-75.6126426,17.79z/data=!4m5!3m4!1s0x8e442983e0facfd7:0x618ebfe559ebad97!8m2!3d6.2446539!4d-75.6123901?hl=es-419',
	'https://www.google.com.co/maps/@6.2433658,-75.6134812,16.29z?hl=es-419',
	'https://www.google.com.co/search?dcr=0&source=hp&ei=X7CaWpv2IaLa5gL7k6f4Aw&q=Cowafucking+peice+of+dog+shit&oq=Cowafucking+peice+of+dog+shit&gs_l=psy-ab.3...3219.11460.0.11610.32.27.0.0.0.0.342.3304.0j16j3j1.21.0....0...1.1.64.psy-ab..11.4.560.6..0j35i39k1j0i131k1j0i10k1.161.IuFHGNsM0L0',
	'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q?foo=bar&a=b#abc',
	'https://www.falabella.com.co/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?%7B%22currentPage%22%3A4%2C%22navState%22%3A%22%2Fcategory%2Fcat3020960%2FPS4%22%7D',
	'/',
];
foreach($urls as $url) {
	$r = Stringer::explodeUrl($url);
	var_dump($r);	
} 
?>