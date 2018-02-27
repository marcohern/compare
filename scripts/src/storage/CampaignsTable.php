<?php

inc("/src/storage/Table.php");

class CampaignsTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('campaigns',$db);
		$this->columns = ['id', 'store_id', 'name', 'code', 'category','table', 'url', 'urltpl', 'executor', 'order', 'created', 'updated'];
		$this->orderby = ['id' => 'ASC'];
	}
}

?>