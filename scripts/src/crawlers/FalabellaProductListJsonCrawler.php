<?php

include_once("src/Logger.php");
include_once("src/JsonCrawler.php");
include_once("src/jsonexplorers/FalabelaBrowserProductJsonExplorer.php");

class FalabellaProductListJsonCrawler extends JsonCrawler {

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
	protected $navState;
	protected $jfalexp;

	public function __construct(Logger $logger, FalabelaBrowserProductJsonExplorer $jsonexp, StandardColumnContainer $cols, $exp) {
		parent::__construct($logger, $jsonexp, $cols, $exp);
		$this->jfalexp = $jsonexp;
		$this->navState = '';
	}

	public function crawlFirst($url, &$table) {
		parent::crawlFirst($url, $table);
		$this->navState = $this->jfalexp->getNavState();
	}

	public function crawlNext($urltpl, &$table) {
		$jp = self::$nextPageJsonTpl;
		$this->p++;
		if ($this->p >= $this->pages) return false;
		$jp = preg_replace('/\[p1\]/', $this->p + 1, $jp);
		$jp = preg_replace('/\[navState\]/', $this->navState, $jp);
		$jp = urlencode($jp);
		$url = $urltpl;
		$url = preg_replace('/\[(json)\]/', $jp, $url);

		$context = stream_context_create(self::$opts);
		$content = mb_convert_encoding(file_get_contents($url, false, $context),'UTF-8');

		$json = json_decode($content);
		if (isset($json->state)) {
			return $this->jfalexp->processState($json->state, $table);
		}
		return false;
	}
}

?>