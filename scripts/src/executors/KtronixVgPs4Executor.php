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
		$this->columns->addName('code',[
			'/^\s*Videojuego (PS4 )?/i',
			'/Edition PS4$/',
			'/PS4$/',
			'/â/',
			'/ Estandard/i',
			'/ Estandar/i',
		],[
			'/WW II/i' => "WWII",
			'/Edicion Legado/i' => "Legacy Edition",
			'/Ratchet y Clank/i' => "Ratchet & Clank",
			'/\W+Remasterizado/i' => " Remastered",
			'/thief.s/i' => "Thief's",
			'/Tortugas Ninja in/i' => "Teenage Mutant Ninja Turtles: Mutants in"
		], ' ps4');
		$this->columns->addSimple('price');
		$this->columns->addSimple('brand');
		$this->columns->addEscape('category');
		$this->columns->addEscape('url');
		
		$this->pagerExp = '/'
			.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
		.'/';

		$this->itemsExp = require('src/expresions/ktronix_product_list.php');

		$this->crawler= new Crawler($this->logger, $this->columns, $this->itemsExp, $this->pagerExp);
 	}
 }

?>