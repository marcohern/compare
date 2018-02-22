<?php

require_once("Logger.php");
/**
 * A logger that writes inserts into the database.
 */
class DbLogger extends Logger {

	private $db; //Database access object
	private static $table = 'log'; //name of log table

	/**
	 * Constructor
	 */
	public function __construct(Database $db) {
		$this->db = $db;
	}

	/**
	 * Save log records
	 */
	private function save() {
		$sql = $this->db->getInsertStmt(self::$table, $this->log);
		$this->clear();
	}

	/**
	 * Record a single log entry 
	 */
	public function log($message, $category = '*', DateTime $start = null, DateTime $end = null)
	{
		parent::log($message, $category, $start, $end);
		$this->save();
	}

	/**
	 * Begin a timed log entry 
	 */
	public function entryStart($message, $category = '*') {
		parent::entryStart($message, $category);
	}

	/**
	 * End a timed log entry 
	 */
	public function entryEnd() {
		parent::entryEnd();
		$this->save();
	}
}

?>