<?php

require_once("Logger.php");

class DbLogger extends Logger {

	private $db;
	private static $table = 'log';

	public function __construct(Database $db) {
		$this->db = $db;
	}

	private function save() {
		$sql = $this->db->getInsertStmt(self::$table, $this->log);
		$this->clear();
	}

	public function log($message, $category = '*', DateTime $start = null, DateTime $end = null)
	{
		parent::log($message, $category, $start, $end);
		$this->save();
	}

	public function entryStart($message, $category = '*') {
		parent::entryStart($message, $category);
	}

	public function entryEnd() {
		parent::entryEnd();
		$this->save();
	}
}

?>