<?php
require_once("../src/compare.php");

inc("/src/http/HttpWeighted.php");
inc("/src/http/HttpVar.php");
inc("/src/http/HttpHeaderItem.php");

$l = HttpWeighted::parse("text/html, application/xhtml+xml, application/xml;q=0.9, */*;q=0.8");
var_dump($l);
echo HttpWeighted::join($l);

$l = HttpVar::parse("PHPSESSID=298zf09hf012fh2; csrftoken=u32t4o3tb3gg43; _gat=1;");
var_dump($l);
echo HttpVar::join($l);

$l = HttpHeaderItem::parse("Accept-Language: fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5");
var_dump($l);
echo HttpVar::join($l);
?>