<?php

require_once("src/CmdLogger.php");
require_once("src/Database.php");
require_once("src/Crawler.php");

abstract class Executor {

 	protected $columns;
 	protected $crawler;
 	protected $jsonExplorer;

 	protected $url;
 	protected $urltpl;
	protected $pagingExp;
	protected $itemsExp;
	protected $table;
	protected $logger;
	protected $db;

	public function __construct() {
		$this->table = [];
		$this->db = new Database();
		$this->logger = new CmdLogger();
		$this->init();
	}

	public function getItems() { return $this->table; }

	abstract protected function init();
	
	public function run() {
		$this->crawler->crawlFirst($this->url, $this->table);
		do {} while($this->crawler->crawlNext($this->urltpl, $this->table));
		$this->logger->log("total records:".count($this->table),"Crawler");
	}

	public function csv() {
		echo "N";
		foreach($this->table[0] as $k => $v) {
			echo ",$k";
		}
		echo "\n";
		$n=0;
		foreach($this->table as $r) {
			echo "$n";
			foreach($r as $v) {
				echo ",\"$v\"";	
			}
			$n++;
			echo "\n";
		}

	} 
}
?>