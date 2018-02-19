<?php

class Logger {
	
	protected $log;
	protected $cnt;

	private $prev;
	private $start;
	private $msta, $mend;

	public function __construct() {
		$this->log = [];
		$this->cnt = 0;
		$this->start = null;
		$this->prev = 0;
	}

	protected function _addToLog($message,  $category, DateTime $start, DateTime $end = null, $duration = 0) {
		$this->log[$this->cnt] = [
			'message'  => $message,
			'category' => $category,
			'start'    => $start->format("Y-m-d H:i:s"),
			'end'      => (empty($end)) ? null : $end->format("Y-m-d H:i:s"),
			'duration' => $duration
		];
		$prev = $this->cnt;
		$this->cnt++;
		//$this->dump();
		return $prev;
	}

	public function log($message, $category = '*', DateTime $start = null, DateTime $end = null)
	{
		$start = (empty($start)) ? new DateTime('now') : $start;
		$duration = (!empty($start) && !empty($end))
			? $end->getTimeStamp() - $start->getTimeStamp() : 0;
		$this->_addToLog($message, $category, $start, $end, $duration);
	}

	public function entryStart($message, $category = '*') {
		$this->start = new DateTime("now");
		$this->msta = microtime(true);
		$this->prev = $this->_addToLog($message, $category, $this->start, $this->start, 0);
	}

	public function entryEnd() {
		$end = new DateTime("now");
		$this->mend = microtime(true);
		$this->log[$this->prev]['end'] = $end->format("Y-m-d H:i:s");
		$this->log[$this->prev]['duration'] = $this->mend - $this->msta;
	}

	public function output() {
		printf("%d items\n", $this->cnt);
		foreach ($this->log as $k => $l) {
			printf("%03d %s %s %s %01.4f %s\n",$k, $l['start'], $l['end'], $l['category'], $l['duration'], $l['message']);
		}
	}

	public function dump() {
		var_dump($this->log);
	}

	public function clear() {
		$this->log = [];
		$this->cnt = 0;
	}
}

?>