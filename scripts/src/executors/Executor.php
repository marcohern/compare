<?php

inc("/src/executors/IExecutor.php");
inc("/src/executors/ExecutorParams.php");
inc("/src/crawlers/PlanCrawler.php");
inc("/src/storage/CampaignsTable.php");
inc("/src/storage/CrawlPlanTable.php");
inc("/src/storage/StoresTable.php");
inc("/src/logging/Logger.php");

abstract class Executor implements IExecutor {
	private $db;
	private $logger;
	private $campaigns;
	private $stores;
	private $plans;

	private $campaign;
	private $store;
	private $plan;

	private $crawler;
	private $params;

	public function __construct(IDatabase $db, Logger $logger) {
		$this->db = $db;
		$this->logger = $logger;
		$this->campaigns = new CampaignsTable($db);
		$this->stores = new StoresTable($db);
		$this->plans = new CrawlPlanTable($db);
		$this->campaign = null;
		$this->store = null;
		$this->plan = null;
		$this->crawler = null;
		$this->params = null;
	}

	protected function log($message) {
		return $this->logger->log($message, get_class($this));
	}

	protected function logStart($message) {
		return $this->logger->start($message, get_class($this));
	}

	protected function logEnd() {
		return $this->logger->end();
	}

	abstract protected function initParams(ExecutorParams &$params); 

	protected function initCrawler(IDatabase $db, Logger $logger, ExecutorParams $params) {
		return new PlanCrawler(
			$db,
			$params->columns,
			$logger
		);
	}

	public function init(&$campaign) {
		$this->store = $this->stores->first(['id' => $campaign->store_id]);
		$this->plan = $this->plans->first([
			'campaign_id' => $campaign->id,
			'status'      => 'PENDING',
		]);
		$this->campaign = $campaign;

		$this->log($this->store->name);
		$this->log($campaign->name);
		$this->log("url: {$campaign->url}");
		$this->log("tpl: {$campaign->urltpl}");
		$this->log("executor: {$campaign->executor}");

		$params = new ExecutorParams();
		$this->initParams($params);
		$this->crawler = $this->initCrawler($this->db, $this->logger, $params);

		$this->params = $params;
	}

	public function run() {
		$this->log("run");
		if ($this->plan) {
			$this->log("There is a plan, execute it");
			$items = $this->crawler->crawlPlan($this->plan, $this->params->itemsExp);

			$this->plan->updated = new DateTime("now");
			$this->plan->status = 'EXECUTED';
			$this->plan->acquired = count($items);
			$this->plans->update($this->plan);
		} else {
			$this->log("There is no plan. Create a new one");
			$this->crawler->crawlFirstAndPlan(
				$this->campaign->url,
				$this->campaign->urltpl,
				$this->params->itemsExp,
				$this->params->pagerExp,
				$this->campaign->id
			);
		}
	}
}

?>