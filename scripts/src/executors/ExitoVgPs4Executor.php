<?php


require_once("src/Executor.php");
require_once("src/StandardColumnContainer.php");
require_once("src/crawlers/FalabellaProductListJsonCrawler.php");
require_once("src/jsonexplorers/FalabelaBrowserProductJsonExplorer.php");

class ExitoVgPs4Executor extends Executor {
	protected function init() {
 		$this->logger->log("init", "ExitoVgPs4Executor");
		$this->url = 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q';
		$this->urltpl = $this->url."?No=[offset]&Nrpp=[rpp]";

		$this->pagerExp = '/'
			.'<p>Mostrando <strong> (\d+) - (?<rpp>\d+) de (?<total>\d+) <\/strong>resultados<\/p>'
		.'/';

		$this->itemsExp = require('src/expresions/exito_product_list.php');

		$this->columns = new StandardColumnContainer();
		$this->columns->addSimple('url1');
		$this->columns->addName('title1',[
			'/^\s*Videojuego /i',
			'/\s*(para)?\s*PS4/i',
			'/\s*-\s+www\.exito\.com/i',
			'/\s*Playstation 4/i',
			'/Nintendo Switch/i',
			'/Edición Estándar/i',
			'/Edición Legendaria/i'
		]);
		$this->columns->addSimple('image1');
		$this->columns->addSimple('image1_alt');
		$this->columns->addSimple('brand1');
		$this->columns->addSimple('price1');
		$this->columns->addSimple('price2');

		$this->crawler = new Crawler($this->logger, $this->columns, $this->itemsExp, $this->pagerExp);
	}
}

?>