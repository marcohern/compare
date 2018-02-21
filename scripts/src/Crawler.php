<?php
require_once("src/exceptions/CrawlerException.php");
require_once("Logger.php");
require_once("StandardColumnContainer.php");

class Crawler {

	protected $cols     = null;
	protected $pagerExp = null;
	protected $exp      = null;
	protected $rpp;
	protected $pages;
	protected $total;
	protected $offset;
	protected $p;
	protected $logger;
	protected $isLastPage;

	public function getRpp  () { return $this->rpp;   }
	public function getTotal() { return $this->total; }

	public function __construct(Logger $logger, StandardColumnContainer $cols, $exp, $pagerExp=null) {
		$this->cols = $cols;
		$this->exp = $exp;
		$this->pagerExp = $pagerExp;
		$this->rpp = 0;
		$this->total = 0;
		$this->pages = 1;
		$this->offset = 0;
		$this->p = 0;
		$this->logger = $logger;
		$this->isLastPage = false; 
	}
	protected function updatePageState() {
		if ($this->rpp) {
			$this->offset += $this->rpp;
		}
		$this->p++;
		$this->isLastPage = false;
		if ($this->p+1 == $this->pages) {
			$this->isLastPage = true;
		}
		if ($this->p >= $this->pages) {
			return false;
		}
		return true;
	}

	protected function getPagingInfo(&$content) {
		if (!is_null($this->pagerExp)) {
			$r = preg_match($this->pagerExp, $content, $pagerMatches);
			if ($r === 1) {
				$this->rpp = $pagerMatches['rpp'];
				$this->total = $pagerMatches['total'];
				$this->pages = ceil($this->total/$this->rpp);
				$this->logger->log("RPP:".$this->rpp." TOTAL:".$this->total." PAGES:".$this->pages,"Crawler");
			}
		}		
	}

	protected function getItems(&$content, &$table) {
		$r = preg_match_all($this->exp, $content, $itemMatches);
		$items = [];
		if ($r !== false) {
			$items = $this->cols->processMatches($itemMatches);
			$expected = (!$this->isLastPage) ? $this->rpp : $this->total - $this->offset;
			$this->logger->log("Expected: ".$expected." items, got ".count($items), "Crawler");
		}
		$table = array_merge($table, $items);
		return $r;
	}

	protected function getUrl(&$urltpl) {
		$url = $urltpl;
		$url = preg_replace('/\[(rpp|limit|r|l)\]/'   , $this->rpp   , $url);
		$url = preg_replace('/\[(start|offset|s|o)\]/', $this->offset, $url);
		$url = preg_replace('/\[p0\]/'                , $this->p     , $url);
		$url = preg_replace('/\[p1\]/'                , $this->p + 1 , $url);
		return $url;
	}

	public function crawlFirst($url, &$table) {
 		$this->logger->log($url, "Crawler");
		$this->logger->entryStart("Reading page ".$this->p,"Crawler");
		$content = mb_convert_encoding(file_get_contents($url),'UTF-8');
		$this->logger->entryEnd();
		$this->getPagingInfo($content);
		return $this->getItems($content, $table);
	}

	public function crawlNext($urltpl, &$table) {

		if ($this->updatePageState()) {
			$url = $this->getUrl($urltpl);
	 		$this->logger->log($url, "Crawler");

			$this->logger->entryStart("Reading page ".$this->p,"Crawler");
			$content = mb_convert_encoding(file_get_contents($url),'UTF-8');
			$this->logger->entryEnd();
			return $this->getItems($content, $table);
		}
		return false;
	}

	public function crawl($url, $urltpl, &$table) {
		$crawler->crawlFirst($url, $table);
		do {} while($crawler->crawlNext($urltpl, $table));
	}
}
?>