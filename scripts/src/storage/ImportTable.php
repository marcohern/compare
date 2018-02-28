<?php

inc("/src/storage/Table.php");

class ImportTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('import',$db);
		$this->columns = null;
		$this->orderby = ['id' => 'ASC'];
	}
}
?>