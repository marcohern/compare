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

	protected function log($message) {
		if (!is_null($this->logger)) {
			$this->logger->log($message, "ProcesorCrawler");
		}
	}

	protected function logStart($message) {
		if (!is_null($this->logger)) {
			$this->logger->start($message, "ProcesorCrawler");
		}
	}

	public function crawl($url, &$exp) {
		$this->logStart("Complete $url");
		{
			$items = parent::crawl($url, $exp);
			$this->logStart("Processing $url");
			{
				foreach ($items as $r) $this->cc->processValues($r);
			}
			$this->logEnd();
		}
		$this->logEnd();
		return $items;
	}
}

?>