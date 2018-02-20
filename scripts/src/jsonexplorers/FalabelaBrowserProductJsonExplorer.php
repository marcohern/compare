<?php

include_once("src/JsonExplorer.php");

class FalabelaBrowserProductJsonExplorer extends JsonExplorer {

	private static $replaceName = [
		'/[áä]/ui' => "a",
		'/[éë]/ui' => "e",
		'/[íï]/ui' => "i",
		'/[óö]/ui' => "o",
		'/[úü]/ui' => "u",
		'/Until Down/i'                    => "Until Dawn",
		'/W2K18/i'                         => "WWE 2K18",
		'/FIFA17/i'                        => "FIFA 17",
		'/FIFA 18 Deluxe/i'                => "FIFA 18",
		'/PES/'                            => "Pro Evolution Soccer",
		'/Blackops/i'                      => "Black Ops",
		'/Fighterz/i'                      => "Fighter Z",
		'/MGSV/i'                          => "Metal Gear Solid V",
		'/Definitive Exp$/i'               => "The Definitive Experience", 
		'/Eve:Valkyrie/i'                  => "Eve: Valkyrie",
		'/Devil¿s/i'                       => "Devil's",
		'/\s*Rem\W*$/i'                    => " Remastered",
		'/\s*Remasterizado$/i'             => " Remastered",
		'/\s*Shippu Ultimate Ninja St 4/i' => " Shipudden Ultimate Ninja Storm 4",
		'/Nfs 2018 Mx Rola/i'              => "Need for Speed Payback",
		'/\s*Spa$/i'                       => " Spanish",
		'/X-X2/i'                          => "X/X2",
		'/Scholar 1 Sin/i'                 => "Scholar of the First Sin",
		'/Origins D$/i'                    => "Origins Deluxe Edition",
		'/Naruto Ninja Storm LG/i'         => "Naruto Shippuden Ultimate Ninja Storm Legacy Game",
		'/\(Edicion Ronaldo\)/i'           => "Ronaldo Edition"
	];
	
	private static $removeName = [
		'/\s*Videojuego /i',
		'/\s*Videjuego /i',
		'/\s*para Playstation 4/i',
		'/\s*-\s*Latam/i',
		'/Edicion \w*$/i',
	];

	protected $navState;
	private $append;
	private $columns;

	public function setAppend($append) { $this->append = $append; }

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

		$this->columns = new StandardColumnContainer();
		$this->columns->addSimple('productId');
		$this->columns->addName('code', self::$removeName, self::$replaceName, ' ps4');
		$this->columns->addSimple('url');
		$this->columns->addSimple('brand');
		$this->columns->addSimple('backendCategory');
		$this->columns->addSimple('skuId');
		$this->columns->addSimple('mediaAssetId');
		$this->columns->addSimple('price');

		foreach($r->resultList as $item) {

			$price = PHP_INT_MAX;
			foreach($item->prices as $pr) {
				if ($pr->originalPrice < $price) {
					$price = $pr->originalPrice;
				}
			}
			$price = "" . ((0 + $price)*1000);

			$record = [
				'productId' => $item->productId,
				'code'      => $item->title,
				'url'       => $item->url,
				'brand'     => isset($item->brand) ? $item->brand : '',
				'backendCategory' => $item->backendCategory,
				'skuId'        => $item->skuId,
				'mediaAssetId' => $item->mediaAssetId,
				'price'        => $price
			];
			$this->columns->processValues($record);
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