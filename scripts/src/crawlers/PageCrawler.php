<?php

inc("/src/crawlers/UrlTemplateCrawler.php");
inc("/src/crawlers/IPageCrawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/logging/Logger.php");

class PageCrawler extends UrlTemplateCrawler implements IPageCrawler {

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
	}

	public function crawlFirst($url, &$itemExp, &$pagingExp) {//<1
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

	public function crawlFirstAndPlan(IDatabase $db, $url, $urltpl, &$itemExp, &$pagingExp) {//<2
		$items = $this->crawlFirst($url, $itemExp, $pagingExp);
		$this->logStart("Creating plan for $url");
		$n = $this->getPages();
		$tb = new CrawlPlanTable($db);
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
			$plan->created  = new DateTime("now");
			$tb->create($plan);
		}
		$this->setPage(0);
		$this->logEnd();
		return $items;
	}

	public function crawlPage($urltpl, &$itemExp) {//<1
		$url = $this->getPageUrl($urltpl);
		return parent::crawl($url, $itemExp);
	}

	public function crawlNext($urltpl, &$itemExp) {//<2
		if ($this->isLastPage()) return false;
		$this->nextPage();
		return parent::crawlPage($urltpl, $itemExp);
	}
}
?>