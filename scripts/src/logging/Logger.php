<?php

inc("/src/logging/LogEntry.php");
inc("/src/logging/ILogger.php");
inc("/src/logging/IDurationLogger.php");

class Logger implements ILogger, IDurationLogger {

	protected $entries;
	protected $micros;

	public function __construct() {
		$this->entries = [];
		$this->micros  = [];
	}

	private function _log($message, $category) {
		$entry = new LogEntry();
		$entry->message = $message;
		$entry->category = $category;
		return $entry;
	} 

	public function log($message, $category='*') {
		return $this->_log($message, $category);
	}

	public function start($message, $category='*') {
		$entry = $this->_log($message, $category);
		$entry->start = new DateTime("now");
		$microstart = microtime(true);

		array_push($this->entries, $entry);
		array_push($this->micros, $microstart);
		
		return $entry;
	}

	public function end() {
		$entry = array_pop($this->entries);
		$microstart = array_pop($this->micros);
		
		$entry->end = new DateTime("now");
		$microend = microtime(true);
		$entry->duration = $microend - $microstart;
		return $entry;
	}
}

?>