<?php

abstract class JsonExplorer {

	protected $rpp;
	protected $total;
	protected $pages;
	
	abstract public function process(&$json, array &$table); 

	public function __construct() {
		$this->rpp   = 0;
		$this->total = 0;
		$this->pages = 0;
	}

	public function getRpp  () { return $this->rpp;   }
	public function getTotal() { return $this->total; }
	public function getPages() { return $this->pages; }
/*
	public function setRpp  ($rpp  ) { $this->rpp   = $rpp;   }
	public function setTotal($total) { $this->total = $total; }
	public function setPages($pages) { $this->pages = $pages; }
	*/
}
?>