<?php

inc('/src/executors/Executor.php');
inc('/src/executors/ExecutorParams.php');
inc('/src/crawlers/FalabellaProductsJsonCrawler.php');
inc('/src/jsonexplorers/FalabellaProductsJsonExplorer.php');
inc("/src/crawlers/StandardColumnContainer.php");

class FalabellaVgPs4Executor extends Executor {
	protected function initParams(ExecutorParams &$params) {
		$params->pagerExp =  '/'
			.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
		.'/';
		$params->itemsExp = read("/src/expresions/falabella_product_list.php");

		$params->columns = new StandardColumnContainer();

		$params->jsonExplorer = new FalabellaProductsJsonExplorer();
	}

	protected function initCrawler(IDatabase $db, Logger $logger, ExecutorParams $params) {
		$crawler = new FalabellaProductsJsonCrawler(
			$db,
			$params->columns,
			$logger
		);
		$crawler->setJsonExplorer($params->jsonExplorer);
		return $crawler;
	}
}

?>