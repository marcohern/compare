<?php

inc("/src/crawlers/ProcesorCrawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/crawlers/IPageStateCrawler.php");
inc("/src/crawlers/IPagingTemplateUrl.php");
inc("/src/logging/Logger.php");
inc("/src/storage/CrawlPlanTable.php");
inc("/src/database/IDatabase.php");

class PageStateCrawler extends ProcesorCrawler implements IPageStateCrawler {
	private $rpp;
	private $total;
	private $pages;

	private $page;
	private $offset;

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
		$this->rpp    = 0;
		$this->total  = 0;
		$this->pages  = 1;
		$this->page   = 0;
		$this->offset = 0;
	}

	public function getRpp  () { return $this->rpp;    }
	public function getTotal() { return $this->total;  }
	public function getPages() { return $this->pages;  }
	public function getPage () { return $this->page;   }
	public function getOffset(){ return $this->offset; }

	public function setRppTotal($rpp,  $total) {
		$this->log("$total records, $rpp records per page.");
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

	public function getPageItemCount() {
		return ($this->isLastPage()) ? $this->total - $this->offset : $this->rpp;
	}
}

?>