<?php

include_once("src/JsonExplorer.php");

class FalabelaBrowserProductJsonExplorer extends JsonExplorer {
	
	private static $removeName = [
		'/\s*Videojuego /',
		'/\s*Videjuego /'
	];

	protected $navState;

	public function getNavState() { return $this->navState; }

	public function processState(&$state, array &$table) {
		$r = null;
		if (isset($state->searchItemList->resultList)) {
			$r = $state->searchItemList;
		} else if (isset($state->resultList)) {
			$r = $state;
		} else {
			return false;
		}

		$this->rpp = $r->resultsPerPage;
		$this->total = $r->resultsTotal;
		$this->pages = $r->pagesTotal;
		$this->navState = $r->selectedRefinements->clearAllUrl;

		foreach($r->resultList as $item) {

			$price = PHP_INT_MAX;
			foreach($item->prices as $pr) {
				if ($pr->originalPrice < $price) {
					$price = $pr->originalPrice;
				}
			}
			$price = "" . ((0 + $price)*1000);

			$name = Stringer::remove($item->title, self::$removeName);
			$code = Stringer::normalize($name);
			$signature = md5($code);
			$record = [
				'productId' => $item->productId,
				'url' => $item->url,
				'brand' => isset($item->brand) ? $item->brand : '',
				'backendCategory' => $item->backendCategory,
				'skuId' => $item->skuId,
				'mediaAssetId' => $item->mediaAssetId,
				'title' => $item->title,
				'name' => $name,
				'code' => $code,
				'signature' => $signature,
				'price' => $price
			];
			$table[] = $record;
		}
		return true;
	}

	public function process(&$json, array &$table) {
		if (isset($json->state)) {
			return $this->processState($json->state, $table);
		}
		return false;
	}
}

?>