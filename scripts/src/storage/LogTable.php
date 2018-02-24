<?php

inc("/src/storage/Table.php");

class LogTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('log', $db);
		$this->columns = ['id', 'category', 'message', 'start', 'end','duration', 'created'];
		$this->orderby = ['id' => 'ASC'];
	}
}

?>