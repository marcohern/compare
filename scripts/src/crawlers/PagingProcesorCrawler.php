<?php

inc("/src/crawlers/ProcesorCrawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/crawlers/IPagingCrawler.php");
inc("/src/crawlers/IPagingTemplateUrl.php");
inc("/src/logging/Logger.php");
inc("/src/storage/CrawlPlanTable.php");
inc("/src/database/IDatabase.php");

class PagingProcesorCrawler extends ProcesorCrawler implements IPagingCrawler, IPagingTemplateUrl {

	private static $rppExp    = '/\[(rowsPerPage|rpp|r|limit|l)\]/i';
	private static $offsetExp = '/\[(startRow|s|offset|o)\]/i';
	private static $page0Exp  = '/\[(ZeroBasePage|p0)\]/i';
	private static $page1Exp  = '/\[(OneBasePage|p1)\]/i';

	private $rpp;
	private $total;
	private $pages;

	private $page;
	private $offset;

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
		$this->rpp = 0;
		$this->total = 0;
		$this->pages = 0;
	}

	public function getRpp  () { return $this->rpp;   }
	public function getTotal() { return $this->total; }
	public function getPages() { return $this->pages; }

	public function setRppTotal($rpp,  $total) {
		$this->rpp = $rpp;
		$this->total = $total;
		$this->pages = ceil($total/$rpp);
	}

	public function setPage($page = 0) {
		$this->page = $page;
		$this->offset = $page*$this->rpp;
	}

	public function nextPage() {
		$this->setPage($this->page + 1);
	}

	public function isLastPage() {
		return ($this->page + 1 == $this->pages) ? true : false;
	}
	
	public function crawlFirst($url, &$itemExp, &$pagingExp) {
		$items = [];
		$this->logStart("Crawling First $url");
		{
			$content = $this->retrieveContent($url);
			$this->logStart("Getting Paging $url");
			{
				$paging = $this->extractData($content, $pagingExp);
			}
			$this->logEnd();

			if (count($paging) > 0) {
				$this->setRppTotal($paging[0]->rpp, $paging[0]->total);
				$this->log("Planing for ".$paging[0]->total." records, with ".$paging[0]->rpp." records per page");
			}
			$this->logStart("Getting Items $url");
			{
				$items = $this->extractData($content, $itemExp);
			}
			$this->logEnd();
		}
		$this->logEnd();
		return $items;
	}

	public function crawlFirstAndPlan(IDatabase $db, $url, $urltpl, &$itemExp, &$pagingExp) {
		$items = $this->crawlFirst($url, $itemExp, $pagingExp);
		$this->logStart("Creating plan for $url");
		$n = $this->getPages();
		$tb = new CrawlPlanTable($db);
		for ($i=1; $i<$n; $i++) {
			$this->setPage($i);
			$url = $this->getPageUrl($urltpl);
			$plan = new stdClass();
			$plan->url = $url;
			$plan->rpp = $this->rpp;
			$plan->total = $this->total;
			$plan->pages = $this->pages;
			$plan->page  = $this->page;
			$plan->offset = $this->offset;
			$plan->expected = ($this->isLastPage()) ? $this->total - $this->offset : $this->rpp;
			$plan->order = rand(100000,999999);
			$plan->status = 'PENDING';
			$plan->created = new DateTime("now");
			$tb->create($plan);
		}
		$this->setPage(0);
		$this->logEnd();
		return $items;
	}

	public function crawlPage($urltpl, &$itemExp) {
		$url = $this->getPageUrl($urltpl);
		return parent::crawl($url, $itemExp);
	}

	public function crawlNext($urltpl, &$itemExp) {
		if ($this->isLastPage()) return false;
		$this->nextPage();
		return parent::crawlPage($urltpl, $itemExp);
	}

	public function getPageUrl($urltpl) {
		$url = $urltpl;
		$url = preg_replace(self::$rppExp   , $this->rpp     , $url);
		$url = preg_replace(self::$offsetExp, $this->offset  , $url);
		$url = preg_replace(self::$page0Exp , $this->page    , $url);
		$url = preg_replace(self::$page1Exp , $this->page + 1, $url);
		return $url;
	}
}

?>