<?php

inc("/src/crawlers/Crawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/logging/Logger.php");

class ProcesorCrawler extends Crawler {

	private $cc;

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($logger);
		$this->cc = $cc;
	}

	public function crawl($url, &$exp) {
		$this->logStart("Complete $url");
		{
			$items = parent::crawl($url, $exp);
			$this->processValues($url, $items);
		}
		$this->logEnd();
		return $items;
	}

	public function processValues($url, &$items) {
		foreach ($items as $r) $this->cc->processValues($r);
	}
}

?>