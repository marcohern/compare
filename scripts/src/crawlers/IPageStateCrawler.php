<?php

inc("/src/database/IDatabase.php");

interface IPageStateCrawler {

	public function getRpp();
	public function getTotal();
	public function getPages();
	public function getPage();
	public function getOffset();

	public function setRppTotal($rpp,  $total);
	public function setPage($page = 0);
	public function nextPage();
	public function isLastPage();
}

?>