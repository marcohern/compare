<?php
require_once('../src/compare.php');

inc('/src/http/HttpHeader.php');
inc('/src/crawlers/Crawler.php');

$h = new HttpHeader();
$h->readFromConfig();
echo "$h\n";

?>