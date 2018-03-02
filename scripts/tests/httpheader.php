<?php
$response = [
	"HTTP/1.1 200 OK",
	"Content-Type: text/html",
	"Connection: close",
	"Cache-Control: no-cache",
	"Connection: close",
	"Content-Length: 2888",
	"X-Iinfo: 5-40679887-0 0NNN RT(1520032536710 846) q(1 -1 -1 0) r(1 -1) B10(8,881023,0) U10000",
	"Set-Cookie: incap_ses_209_678271=s4GOK6Lq7njmj5Bh94XmAhnbmVoAAAAAeYQVy7cDuaWWAMhbwrUNqQ==; path=/; Domain=.exito.com"
];

require_once('../src/compare.php');

inc('/src/util/HttpHeader.php');

$h = new HttpHeader();
$h->read();
$h->setCookies($response);

echo $h->toString()."\n";
?>