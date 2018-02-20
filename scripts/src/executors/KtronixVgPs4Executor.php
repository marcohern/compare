<?php

require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");

class KtronixVgPs4Executor extends Executor {

 	protected function init() {
 		$this->logger->log("init", "KtronixVgPs4Executor");
 		$this->url = "http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
 		$this->urltpl = $this->url."?p=[p1]";

 		$this->columns = new StandardColumnContainer();
		$this->columns->addSimple('id');
		$this->columns->addName('name',[
			'/^\s*Videojuego (PS[43] |XBOX ONE (X )?)?/i',
			'/Edition PS[43]$/',
			'/ XBOX ONE/',
			'/â/',
			'/ Estandard/i',
			'/ Estandar/i'
		]);
		$this->columns->addSimple('price');
		$this->columns->addSimple('brand');
		$this->columns->addEscape('category');
		
		$this->pagerExp = '/'
			.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
		.'/';

		$this->itemsExp = require('src/expresions/ktronix_product_list.php');

		$this->crawler= new Crawler($this->logger, $this->columns, $this->itemsExp, $this->pagerExp);
 	}
 }

?>