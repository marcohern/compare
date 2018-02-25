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