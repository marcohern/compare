<?php

inc("/src/database/IDatabase.php");
inc("/src/logging/Logger.php");
inc("/src/logging/LogEntry.php");
inc("/src/storage/LogTable.php");

class DatabaseLogger extends Logger {

	private $tb;

	public function __construct(IDatabase $db) {
		$this->tb = new LogTable($db);
	}

	private function save(&$entry) {
		$r = $this->tb->create($entry);
		return $r;
	}

	public function log($message, $category='*') {
		$entry = parent::log($message,  $category);
		return $this->save($entry);
	}

	public function end() {
		$entry = parent::end();
		return $this->save($entry);
	}
}

?>