<?php

require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");

class KtronixVgPs4Executor extends Executor {

	protected function initUrls() {
		$url = "http://www.ktronix.com/videojuegos/play-station-ps3-ps4-psvita-move/videojuegos-playstation/juegos-playstation-4";
 		$urltpl = $url."?p=[p1]";
 		return [ $url,  $urltpl ];
	}

	protected function initColumns() {
		$columns = new StandardColumnContainer();
		$columns->addName('code',[
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
		$columns->addEscape('category');
		$columns->addEscape('url');

		return $columns;
	}

	protected function initItemsRegex() {
		return require('src/expresions/ktronix_product_list.php');
	}

	protected function initPagingRegex() {
		return '/'
			.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
		.'/';
	}
 }

?>