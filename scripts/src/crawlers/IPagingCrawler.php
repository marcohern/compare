<?php

inc("/src/database/IDatabase.php");

interface IPagingCrawler {

	public function getRpp();
	public function getTotal();
	public function getPages();

	public function setRppTotal($rpp,  $total);
	public function setPage($page = 0);
	public function nextPage();
	public function isLastPage();
	
	public function crawlFirst($url, &$itemExp, &$pagingExp);
	public function crawlFirstAndPlan(IDatabase $db, $url, $urltpl, &$itemExp, &$pagingExp);
	public function crawlPage($urltpl, &$itemExp);
	public function crawlNext($urltpl, &$itemExp);
}

?>