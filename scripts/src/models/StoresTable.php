<?php

inc("/src/models/Table.php");

class StoresTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('stores',$db);
		$this->columns = ['id', 'code', 'name', 'country', 'url', 'created', 'updated'];
		$this->orderby = ['id' => 'ASC'];
	}
}

?>