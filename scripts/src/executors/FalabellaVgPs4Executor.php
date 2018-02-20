<?php


require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");
require_once("src/crawlers/FalabellaProductListJsonCrawler.php");
require_once("src/jsonexplorers/FalabelaBrowserProductJsonExplorer.php");

class FalabellaVgPs4Executor extends Executor {
	protected function init() {
 		$this->logger->log("init", "FalabellaVgPs4Executor");
		$this->url = 'https://www.falabella.com.co/falabella-co/category/cat3020960/PS4';
		$this->urltpl = 'https://www.falabella.com.co/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?[json]';
		$this->itemsExp = '/'
			.'var fbra_browseProductListConfig = (?<json>\{.*\});\s+'
			.'var fbra_browseProductList'
		.'/';

		$this->columns = new StandardColumnContainer();
		$this->jsonExplorer = new FalabelaBrowserProductJsonExplorer();

		$this->columns->addSimple('json');

		$this->crawler = new FalabellaProductListJsonCrawler($this->logger, $this->jsonExplorer, $this->columns, $this->itemsExp);
	}
}

?>