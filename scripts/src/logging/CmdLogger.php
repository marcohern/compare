<?php

inc("/src/logging/Logger.php");

class CmdLogger extends Logger{

	public function __construct() {
		parent::__construct();
	}

	private function _output(&$entry) {
		echo $entry->category.' '
		.(($entry->duration>0) ? $entry->duration.'s' : '')
		.' '.$entry->message."\n";
	}

	public function log($message, $category='*') {
		$entry = parent::log($message, $category);
		$this->_output($entry);
		return $entry;
	}

	public function start($message, $category='*') {
		$entry = parent::start($message, $category);
		return $entry;
	}

	public function end() {
		$entry = parent::end();
		$this->_output($entry);
		return $entry;
	}
}
?>