<?php

inc("/src/crawlers/PageCrawler.php");
inc("/src/crawlers/IPlanCrawler.php");
inc("/src/database/IDatabase.php");

class PlanCrawler extends PageCrawler implements IPlanCrawler {

	private $db;

	public function __construct(IDatabase $db, ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
		$this->db = $db;
	}

	public function crawlFirstAndPlan($url, $urltpl, &$itemExp, &$pagingExp, $campaign_id) {
		$items = $this->crawlFirst($url, $itemExp, $pagingExp);
		$this->logStart("Creating plan for $url");
		$n = $this->getPages();
		$tb = new CrawlPlanTable($this->db);
		$this->log("$n pages");
		for ($i=1; $i<$n; $i++) {
			$this->setPage($i);
			$url = $this->getPageUrl($urltpl);
			$plan = new stdClass();
			$plan->url      = $url;
			$plan->rpp      = $this->getRpp();
			$plan->total    = $this->getTotal();
			$plan->pages    = $this->getPages();
			$plan->page     = $this->getPage();
			$plan->offset   = $this->getOffset();
			$plan->expected = $this->getPageItemCount();
			$plan->order    = rand(100000,999999);
			$plan->status   = 'PENDING';
			$plan->campaign_id = $campaign_id;
			$plan->created  = new DateTime("now");
			$tb->create($plan);
		}
		$this->setPage(0);
		$this->logEnd();
		return $items;
	}

	public function crawlPlan(&$plan, &$exp) {
		$this->setRppTotal($plan->rpp, $plan->total);
		$this->logStart("Crawling Plan, expecting ".$plan->expected." records in page ".$plan->page.", offset ".$plan->offset);
		$this->setPage($plan->page);
		$items = $this->crawl($plan->url, $exp);
		$this->logEnd();
		return $items;
	}
}

?>