<?php

inc("/src/logging/Logger.php");
inc("/src/logging/IMemLogger.php");

class MemLogger extends Logger implements IMemLogger {
	private $log;
	private $cnt;

	public function __construct() {
		parent::__construct();
		$this->log = [];
		$this->cnt = 0;
	}

	private function _add(&$entry) {
		$this->log[$this->cnt] = $entry;
		$this->cnt++;
	}

	public function log($message, $category='*') {
		$entry = parent::log($message, $category);
		$this->_add($entry);
		return $entry;
	}

	public function start($message, $category='*') {
		$entry = parent::start($message, $category);
		return $entry;
	}

	public function end() {
		$entry = parent::end();
		$this->_add($entry);
		return $entry;
	}

	public function getEntries() {
		return $this->log;
	}

	public function clearEntries() {
		$this->log = [];
		$this->cnt = 0;
	}
}
?>