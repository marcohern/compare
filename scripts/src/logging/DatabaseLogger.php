<?php

inc("/src/database/IDatabase.php");
inc("/src/logging/Logger.php");
inc("/src/logging/LogEntry.php");
inc("/src/storage/LogTable.php");

class DatabaseLogger extends Logger {

	private $tb;

	public function __construct(IDatabase $db) {
		parent::__construct();
		$this->tb = new LogTable($db);
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
		return $this->create($entry);
	}

	public function end() {
		$entry = parent::end();
		return $this->update($entry);
	}
}

?>