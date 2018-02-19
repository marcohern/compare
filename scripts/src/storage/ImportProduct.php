<?php

require_once('src/Database.php');

class ImportProduct {

	protected static $idCol = '_id';
	protected static $processIdCol = '_processId';
	protected $db;
	protected $_id;
	protected $_processId;

	public function __construct(Database $db) {
		$this->db = $db;
	}
}
?>