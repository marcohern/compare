<?php

inc("/src/executors/Executor.php");
inc("/src/crawlers/StandardColumnContainer.php");

class ExitoVgPs4Executor extends Executor {

	protected function initParams(ExecutorParams &$params) {
		$params->pagerExp =  '/'
			.'<p>Mostrando <strong> (\d+) - (?<rpp>\d+) de (?<total>\d+) <\/strong>resultados<\/p>'
		.'/';
		$params->itemsExp = read('/src/expresions/exito_product_list.php');

		$columns = new StandardColumnContainer();
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

		$params->columns = $columns;
	}
}

?>