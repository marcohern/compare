<?php

inc('/src/jsonexplorers/JsonExplorer.php');
inc('/src/crawlers/StandardColumnContainer.php');

class FalabellaProductsJsonExplorer extends JsonExplorer {

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

	private $rpp;
	private $total;
	private $navState;
	public function getRpp() { return $this->rpp; }
	public function getTotal() { return $this->total; }
	public function getNavState() { return $this->navState; }

	public function explore(&$json) {
		$this->rpp = $json->resultsPerPage;
		$this->total = $json->resultsTotal;
		$this->navState = $json->selectedRefinements->clearAllUrl;

		$columns = new StandardColumnContainer();
		$columns->addName('code', self::$removeName, self::$replaceName, ' ps4');
		$table = [];
		foreach ($json->resultList as $product) {
			$price = PHP_INT_MAX;
			foreach($product->prices as $pr) {
				if ($pr->originalPrice < $price) {
					$price = $pr->originalPrice;
				}
			}
			$price = "" . ((0 + $price)*1000);

			$record = (object)[
				'productId' => $product->productId,
				'code'      => $product->title,
				'url'       => $product->url,
				'brand'     => isset($product->brand) ? $product->brand : '',
				'backendCategory' => $product->backendCategory,
				'skuId'        => $product->skuId,
				'mediaAssetId' => $product->mediaAssetId,
				'price'        => $price
			];
			$columns->processValues($record);
			$table[] = $record;
		}
		return $table;
	}
}

?>