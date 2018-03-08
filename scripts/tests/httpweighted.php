<?php
require_once("../src/compare.php");

inc("/src/http/HttpHeader.php");

//$url = 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q';
$url = 'https://edition.cnn.com/';
$charset = 'UTF-8';
$source = "accept: */*\r\n"
		 ."accept-language: en-US,en;q=0.9,es-419;q=0.8,es;q=0.7\r\n"
		 ."accept-language: fr-FR,fr;q=0.9,fr-419;q=0.8,pr;q=0.7\r\n"
		 ."accept-encoding: identity\r\n";

$s = new HttpHeader($source);
var_dump($s->query('accept-language'));
echo "$s\n";
die("die");
$ops = [
	'http' => [
		'method' => 'GET',
		'header' => ''.$s
	]
];

$context = stream_context_create($ops);
$content = mb_convert_encoding(file_get_contents($url, false, $context),$charset);

$h = new HttpHeader($http_response_header);

$cookie = $s->cookie;
$setCookie = $h->setCookie;
var_dump($cookie);
var_dump($setCookie);

?>