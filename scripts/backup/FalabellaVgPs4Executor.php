<?php


require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");
require_once("src/crawlers/FalabellaProductListJsonCrawler.php");
require_once("src/jsonexplorers/FalabelaBrowserProductJsonExplorer.php");

class FalabellaVgPs4Executor extends Executor {

	protected function initUrls() {
		$url = "https://www.falabella.com.co/falabella-co/category/cat3020960/PS4";
 		$urltpl = "https://www.falabella.com.co/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?[json]";
 		return [ $url,  $urltpl ];
	}

	protected function initColumns() {
		$columns = new StandardColumnContainer();
		$columns->addSimple('json');
		return $columns;
	}

	protected function initItemsRegex() {
		return '/'
			.'var fbra_browseProductListConfig = (?<json>\{.*\});\s+'
			.'var fbra_browseProductList'
		.'/';;
	}

	protected function initPagingRegex() {
		return null;
	}

	protected function initJsonExplorer() {
		$jsonExplorer = new FalabelaBrowserProductJsonExplorer();
		$jsonExplorer->setAppend(' ps4');
		return $jsonExplorer;
	}

	protected function initCrawler(&$logger, &$columns, &$jsonExplorer, &$itemsExp, &$pagingExp) {
		return new FalabellaProductListJsonCrawler(
			$logger,
			$jsonExplorer,
			$columns,
			$itemsExp
		);
	}
}

?>