<?php

inc('/src/database/mysql/MySqlDatabase.php');
inc('/src/storage/CampaignsTable.php');
inc('/src/storage/CrawlPlanTable.php');
inc('/src/storage/StoresTable.php');
inc('/src/logging/CmdLogger.php');
inc('/src/programs/IProgram.php');

abstract class Program implements IProgram {
	protected $logger;

	protected $db;
	protected $campaigns;
	protected $plans;
	protected $stores;

	public function run() {
		$this->init();
		$this->execute();
		$this->shutdown();
	}

	public function init() {
		$this->logger = new CmdLogger();
		$this->db = new MySqlDatabase();

		$this->campaigns = new CampaignsTable($this->db);
		$this->plans     = new CrawlPlanTable($this->db);
		$this->stores    = new StoresTable($this->db);
		$this->db->connect();
		$this->log("Begin Crawl Program");
	}

	public function shutdown() {
		$this->db->close();
		$this->log("End Crawl Program");
	}

	public function log($message) {
		$this->logger->log($message, get_class($this));
	}

	abstract protected function execute();
}

?>