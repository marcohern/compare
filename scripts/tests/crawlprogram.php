<?php

require_once("../src/compare.php");

inc('/src/programs/CrawlProgram.php');

$pr = new CrawlProgram();

$pr->run();

?>