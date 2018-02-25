<?php


require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");
require_once("src/crawlers/FalabellaProductListJsonCrawler.php");
require_once("src/jsonexplorers/FalabelaBrowserProductJsonExplorer.php");

class ExitoVgPs4Executor extends Executor {

	protected function initUrls() {
		$url = "https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q";
		$urltpl = "$url?No=[offset]&Nrpp=[rpp]";
 		return [ $url,  $urltpl ];
	}

	protected function initColumns() {

		$columns = new StandardColumnContainer();
		$columns->addSimple('url1');
		$columns->addName('code',[
			'/^\s*Videojuego /i',
			'/\s*(para)?\s*PS4/i',
			'/\s*-\s+www\.exito\.com/i',
			'/\s*Playstation 4/i',
			'/Nintendo Switch/i',
			'/Edición Estándar/i',
			'/Edición Legendaria/i'
		],[
			'/[áä]/ui' => "a",
			'/[éë]/ui' => "e",
			'/[íï]/ui' => "i",
			'/[óö]/ui' => "o",
			'/[úü]/ui' => "u",
		], ' ps4');
		$columns->addSimple('image1');
		$columns->addSimple('image1_alt');
		$columns->addSimple('brand1');
		$columns->addSimple('price1');
		$columns->addSimple('price2');

		return $columns;
	}

	protected function initItemsRegex() {
		return require('src/expresions/exito_product_list.php');
	}

	protected function initPagingRegex() {
		return '/'
			.'<p>Mostrando <strong> (\d+) - (?<rpp>\d+) de (?<total>\d+) <\/strong>resultados<\/p>'
		.'/';
	}
}

?>