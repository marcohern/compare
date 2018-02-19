<?php

require_once("Logger.php");

class CmdLogger extends Logger {

	private function print() {
		foreach($this->log as $r) {
			echo $r['category'].' '.$r['message'].' '
				.(($r['duration']>0) ? $r['duration'].'s' : '')."\n";
		}
	}

	public function log($message, $category = '*', DateTime $start = null, DateTime $end = null)
	{
		parent::log($message, $category, $start, $end);
		$this->print();
		$this->clear();
	}

	public function entryStart($message, $category = '*') {
		parent::entryStart($message, $category);
	}

	public function entryEnd() {
		parent::entryEnd();
		$this->print();
		$this->clear();
	}
}

?>