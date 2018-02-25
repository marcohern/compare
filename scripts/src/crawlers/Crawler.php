<?php

inc("/src/crawlers/ICrawler.php");
inc("/src/logging/Logger.php");

class Crawler implements ICrawler {

	private $charset;
	protected $logger;

	public function __construct(Logger $logger = null) {
		$this->charset = 'UTF-8';
		$this->logger = $logger;
	}

	protected function log($message) {
		if (!is_null($this->logger)) {
			$this->logger->log($message, get_class($this));
		}
	}

	protected function logStart($message) {
		if (!is_null($this->logger)) {
			$this->logger->start($message, get_class($this));
		}
	}

	protected function logEnd() {
		if (!is_null($this->logger)) {
			$this->logger->end();
		}
	}

	public function crawl($url, &$exp) {
		$this->logStart("Crawling $url");
		$content = $this->retrieveContent($url);
		$items = $this->extractData($content, $exp);
		$this->logEnd();
		return $items;
	}

	public function retrieveContent(&$url) {
		return mb_convert_encoding(file_get_contents($url),$this->charset);
	}

	public function extractData(&$content, &$exp) {
		$matches = [];
		$r = preg_match_all($exp, $content, $matches);
		$items = [];
		if ($r !== false) {
			$n = count($matches[0]);
			for($i=0;$i<$n;$i++) {
				$items[$i] = new stdClass();
				foreach($matches as $c => $v) {
					if (is_string($c))
						$items[$i]->$c = $matches[$c][$i];
				}
			}
		}
		return $items;
	}
}

?>