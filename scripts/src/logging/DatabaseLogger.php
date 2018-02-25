<?php

inc("/src/database/IDatabase.php");
inc("/src/logging/Logger.php");
inc("/src/logging/LogEntry.php");
inc("/src/storage/LogTable.php");

class DatabaseLogger extends Logger {

	private $tb;
	private $logAtEnd;

	public function __construct(IDatabase $db, $logAtEnd = true) {
		parent::__construct();
		$this->tb = new LogTable($db);
		$this->logAtEnd = $logAtEnd;
	}

	private function create(&$entry) {
		$r = $this->tb->create($entry);
		return $r;
	}

	private function update(&$entry) {
		$entry->update();
		$r = $this->tb->update($entry);
		return $r;
	}

	public function log($message, $category='*') {
		$entry = parent::log($message,  $category);
		return $this->create($entry);
	}

	public function start($message, $category='*') {
		$entry = parent::start($message, $category);
		if ($this->logAtEnd) return $entry; 
		else return $this->create($entry);
	}

	public function end() {
		$entry = parent::end();
		if ($this->logAtEnd) return $this->create($entry);
		else return $this->update($entry);
	}
}

?>