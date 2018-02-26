<?php

inc('/src/crawlers/IJsonCrawler.php');
inc('/src/crawlers/PlanCrawler.php');

class JsonCrawler extends PlanCrawler implements IJsonCrawler {
	protected $jsonExplorer;

	public function setJsonExplorer(JsonExplorer $jex) {
		$this->jsonExplorer = $jex;
	}

	public function crawlFirst($url, &$itemExp, &$pagingExp) {
		$result = parent::crawl($url, $itemExp);
		$json = json_decode($result[0]->json);
		$items = $this->jsonExplorer->explore($json->state->searchItemList);
		$this->log("crawlFirst done!");
		$this->log(count($items)." record!");
		$this->setRppTotal(
			$this->jsonExplorer->getRpp(),
			$this->jsonExplorer->getTotal()
		);
		return $items;
	}
}
?>