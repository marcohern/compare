<?php

inc("/src/storage/Table.php");

class CrawlPlanTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('crawlplan', $db);
		$this->columns = ['id', 'url', 'expected', 'status', 'created', 'updated'];
		$this->orderby = ['id' => 'ASC'];
	}
}

?>