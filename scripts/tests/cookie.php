<?php
require_once('../src/compare.php');

inc('/src/http/CookieHeader.php');
inc('/src/util/Urler.php');



$url = 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q';
$urlx = Urler::explode($url);

$charset = 'UTF-8';


$h = new CookieHeader();
$h->readFromConfig();

echo "REQUEST:\n";
$h->dump();

$content = mb_convert_encoding(file_get_contents($url), $charset);

echo "RESPONSE DUMP:\n";
var_dump($http_response_header);
$r = new CookieHeader();
$r->readFromArray($http_response_header);

echo "RESPONSE:\n";
$r->dump();

$cookies = $r->get('set-cookie');
//var_dump($cookies);

$h->mergeCookies($cookies);

echo "NEW REQUEST:\n$h\n";

?>