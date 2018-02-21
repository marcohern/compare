<?php
require_once("src/exceptions/CrawlerException.php");
require_once("Logger.php");
require_once("StandardColumnContainer.php");

/**
 * Crawls an specific set of urls.
 * It essentially captures remote content from the URL and passes 
 * it through a regular expression to extract information into a table.
 * The url content, regular expression and table schema ultimately determine what info is captured. 
 * Crawler is also designed to distinguish between a first page 
 * and subsequent pages if available.
 */
class Crawler {

	protected $cols     = null; //Columns
	protected $pagerExp = null; //Regular expression that captures paging information
	protected $exp      = null; //Regular expression that captures items or records
	protected $rpp;       //stores Records per page, if found
	protected $pages;     //stores Number of pages, if found
	protected $total;     //stores total number of records, if found
	protected $offset;    //Stores current row offset, if applies
	protected $p;         //Stores current page (first page is zero)
	protected $logger;    //Logger
	protected $isLastPage;//true if it is currently the last available page.

	/**
	 * Geters
	 */
	public function getRpp  () { return $this->rpp;   }
	public function getTotal() { return $this->total; }

	/**
	 * Constructor
	 */
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

	/**
	 * Increments the paging state to the next page.
	 */
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

	/**
	 * captures paging information from the remote content.
	 */
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

	/**
	 * Captures all the items from the remote content
	 */
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

	/**
	 * Build the url from a given template
	 */
	protected function getUrl(&$urltpl) {
		$url = $urltpl;
		$url = preg_replace('/\[(rpp|limit|r|l)\]/'   , $this->rpp   , $url);
		$url = preg_replace('/\[(start|offset|s|o)\]/', $this->offset, $url);
		$url = preg_replace('/\[p0\]/'                , $this->p     , $url);
		$url = preg_replace('/\[p1\]/'                , $this->p + 1 , $url);
		return $url;
	}

	/**
	 * Crawl a main index url.
	 * The main index url is explored for paging information, to figure out
	 * how many pages are available, and also the first set of items.
	 */
	public function crawlFirst($url, &$table) {
 		$this->logger->log($url, "Crawler");
		$this->logger->entryStart("Reading page ".$this->p,"Crawler");
		$content = mb_convert_encoding(file_get_contents($url),'UTF-8');
		$this->logger->entryEnd();
		$this->getPagingInfo($content);
		return $this->getItems($content, $table);
	}

	/**
	 * Crawl a subsequent url from a template.
	 * The next url is generated from a template where the paging information is annexed.
	 */
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

	/**
	 * Crawl a complete set of urls.
	 * If a first page contains paging information, the rest of the pages are crawled upon.
	 */
	public function crawl($url, $urltpl, &$table) {
		$crawler->crawlFirst($url, $table);
		do {} while($crawler->crawlNext($urltpl, $table));
	}
}
?>