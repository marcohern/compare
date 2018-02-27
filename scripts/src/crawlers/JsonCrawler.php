<?php

inc('/src/crawlers/IJsonCrawler.php');
inc('/src/crawlers/PlanCrawler.php');

class JsonCrawler extends PlanCrawler implements IJsonCrawler {

	protected $jsonExplorer;

	public function setJsonExplorer(JsonExplorer $jex) {
		$this->jsonExplorer = $jex;
	}
}
?>