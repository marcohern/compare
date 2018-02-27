<?php

inc("/src/storage/Table.php");

class CrawlPlanTable extends Table {

	public function __construct(IDatabase $db) {
		parent::__construct('crawlplan', $db);
		$this->columns = ['id', 'url', 'expected', 'status', 'order', 'created', 'updated'];
		$this->orderby = ['order' => 'ASC'];
	}

	public function deleteOldUnexecuted() {
		$someTimeAgo = new DateTime("now");
		$period = new DateInterval("P30D");
		$someTimeAgo->sub($period);
		return $this->db->delete($this->table,[
			'status' => 'EXECUTED', 
			['created', '<', $someTimeAgo]
		]);
	}
}

?>