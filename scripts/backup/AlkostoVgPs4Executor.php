<?php

require_once("src/StandardColumnContainer.php");
require_once("src/executors/KtronixVgPs4Executor.php");

class AlkostoVgPs4Executor extends KtronixVgPs4Executor {

 	protected function initUrls() {
 		$url = "http://www.alkosto.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
 		$urltpl = $url."?p=[p1]";
 		return [ $url,  $urltpl ];
 	}
 }

?>