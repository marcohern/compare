<?php

require_once("Logger.php");
require_once("JsonExplorer.php");
require_once("Crawler.php");

class JsonCrawler extends Crawler {
	protected $jsonexp;

	public function __construct(Logger $logger, JsonExplorer $jsonexp, StandardColumnContainer $cols, $exp) {
		parent::__construct($logger, $cols, $exp);
		$this->jsonexp = $jsonexp;
	}

	public function crawlFirst($url, &$table) {
		$xtb = [];
		$r = parent::crawlFirst($url, $xtb);
		//var_dump($xtb);
		if ($r) {
			$json = json_decode($xtb[0]['json']);
			$this->jsonexp->process($json, $table);
			$this->rpp = $this->jsonexp->getRpp();
			$this->total = $this->jsonexp->getTotal();
			$this->pages = $this->jsonexp->getPages();
			$this->offset = 0;
			$this->p = 0;			
		}
		return $r;
	}
}

?>