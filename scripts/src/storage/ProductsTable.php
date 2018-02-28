<?php

inc("/src/storage/Table.php");

class ProductsTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('prd_TABLE_NOT_SET',$db);
		$this->idkey   = '_id';
		$this->columns = null;
		$this->orderby = ['_id' => 'ASC'];
	}

	public function setTable($table) {
		$this->table = $table;
	}
}

?>