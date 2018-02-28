<?php

inc("/src/crawlers/UrlTemplateCrawler.php");
inc("/src/crawlers/IPageCrawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/logging/Logger.php");

class PageCrawler extends UrlTemplateCrawler implements IPageCrawler { 

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
	}

	public function crawlFirst($url, &$itemExp, &$pagingExp) {
		$this->logStart("Crawling $url");
		$items = [];
		$paging = null;
		$content = $this->retrieveContent($url);
		$paging = $this->extractData($content, $pagingExp);

		if (count($paging) > 0) {
			$this->setRppTotal($paging[0]->rpp, $paging[0]->total);
		}
		$items = $this->extractData($content, $itemExp);
		$this->processValues($url, $items);
		$this->logEnd();
		$n = count($items);
		$this->log("Captured $n item(s)");
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