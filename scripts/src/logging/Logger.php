<?php

inc("/src/logging/LogEntry.php");
inc("/src/logging/ILogger.php");
inc("/src/logging/IDurationLogger.php");

class Logger implements ILogger, IDurationLogger {

	protected $entry;
	protected $microstart;

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

		$this->entry = $entry;
		$this->microstart = microtime(true);
		
		return $entry;
	}

	public function end() {
		$this->entry->end = new DateTime("now");
		$microend = microtime(true);
		$this->entry->duration = $microend - $this->microstart;
		return $this->entry;
	}
}

?>