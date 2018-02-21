<?php

require_once("Logger.php");

/**
 * A logger that writes to the command line.
 */
class CmdLogger extends Logger {

	/**
	 * output entry to the command line
	 */
	private function print() {
		foreach($this->log as $r) {
			echo $r['category'].' '.$r['message'].' '
				.(($r['duration']>0) ? $r['duration'].'s' : '')."\n";
		}
	}

	/**
	 * Log a message and output to the command line
	 */
	public function log($message, $category = '*', DateTime $start = null, DateTime $end = null)
	{
		parent::log($message, $category, $start, $end);
		$this->print();
		$this->clear();
	}

	/**
	 * start a timed entry
	 */
	public function entryStart($message, $category = '*') {
		parent::entryStart($message, $category);
	}

	/**
	 * end a timed entry
	 */
	public function entryEnd() {
		parent::entryEnd();
		$this->print();
		$this->clear();
	}
}

?>