<?php

inc("/src/executors/Executor.php");
inc("/src/crawlers/StandardColumnContainer.php");

class KtronixVgPs4Executor extends Executor {

	protected function initParams(ExecutorParams &$params) {
		$params->pagerExp =  '/'
			.'Productos: 1-(?<rpp>\d{1,4}) de (?<total>\d{1,4})'
		.'/';
		$params->itemsExp = read("/src/expresions/ktronix_product_list.php");

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

		$params->columns = $columns;
	}
}

?>