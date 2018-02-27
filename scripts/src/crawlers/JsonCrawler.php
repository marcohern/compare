<?php

inc('/src/crawlers/IJsonCrawler.php');
inc('/src/crawlers/PlanCrawler.php');

class JsonCrawler extends PlanCrawler implements IJsonCrawler {
	private static $nextPageJsonTpl = '{"currentPage":[p1],"navState":"[navState]"}';
	private static $opts = [
		'http'=>[
			'method'=>"GET",
			'header'=>":authority: www.falabella.com.co\r\n"
					 .":method: GET\r\n"
					 .":path: /rest/model/falabella/rest/browse/BrowseActor/get-product-record-list?%7B%22currentPage%22%3A2%2C%22navState%22%3A%22%2Fcategory%2Fcat3020960%2FPS4%22%7D\r\n"
					 .":scheme: https\r\n"
					 ."Accept-language: en-US,en;q=0.9,es-419;q=0.8,es;q=0.7\r\n"
					 ."Accept: */*\r\n"
					 ."accept-encoding: identity\r\n"
					 ."Content-type: application/json\r\n"
					 ."Adrum: isAjax:true\r\n"
					 ."Referer: https://www.falabella.com.co/falabella-co/category/cat3020960/PS4\r\n"
		]
	];

	protected $jsonExplorer;

	public function setJsonExplorer(JsonExplorer $jex) {
		$this->jsonExplorer = $jex;
	}

	public function getPageUrl($urltpl) {
		$json = self::$nextPageJsonTpl;
		$json = preg_replace('/\[p1\]/', $this->getPage()+1, $json);
		$json = preg_replace('/\[navState\]/', $this->jsonExplorer->getNavState(), $json);
		$json = urlencode($json);

		$url = $urltpl;
		$url = preg_replace('/\[json\]/', $json, $url);
		return $url;
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

	public function crawlPlan(&$plan, &$exp) {
		$context = stream_context_create(self::$opts);
		$this->setContext($context);
		$result = $this->retrieveContent($plan->url);
		$json = json_decode($result);
		$items = $this->jsonExplorer->explore($json->state);
		$this->log("crawlPlan done!");
		$this->log(count($items)." record!");
		return $items;
	}
}
?>