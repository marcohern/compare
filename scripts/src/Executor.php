<?php

require_once("src/CmdLogger.php");
require_once("src/Database.php");
require_once("src/Crawler.php");

abstract class Executor {

 	private $url;
 	private $urltpl;
 	private $columns;
 	private $crawler;
	private $pagingExp;
	private $itemsExp;
 	
 	protected $jsonExplorer;
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

	private function init() {

 		$this->logger->log("init", "Executor");
 		
		$ua = $this->initUrls();
		if (array_key_exists(0, $ua)) {
			$this->url = $ua[0];	
		} else if (array_key_exists('url', $ua)) {
			$this->url = $ua['url'];
		}
		if (array_key_exists(1, $ua)) {
			$this->urltpl = $ua[1];	
		} else if (array_key_exists('urltpl', $ua)) {
			$this->urltpl = $ua['urltpl'];
		}
		$this->columns   = $this->initColumns();
		$this->itemsExp  = $this->initItemsRegex();
		$this->pagingExp = $this->initPagingRegex();
		$this->crawler   = $this->initCrawler();
	}

	abstract protected function initUrls();
	abstract protected function initColumns();
	abstract protected function initItemsRegex();
	abstract protected function initPagingRegex();
	
	protected function initCrawler() {
		return new Crawler(
			$this->logger,
			$this->columns,
			$this->itemsExp,
			$this->pagingExp
		);
	}
	
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