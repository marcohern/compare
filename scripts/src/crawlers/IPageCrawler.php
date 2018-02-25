<?php
interface IPageCrawler {
	public function crawlFirst($url, &$itemExp, &$pagingExp);
	public function crawlPage($urltpl, &$itemExp);
	public function crawlNext($urltpl, &$itemExp);
}
?>