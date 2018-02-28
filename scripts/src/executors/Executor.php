<?php

inc("/src/executors/IExecutor.php");
inc("/src/executors/ExecutorParams.php");
inc("/src/crawlers/PlanCrawler.php");
inc("/src/storage/CampaignsTable.php");
inc("/src/storage/CrawlPlanTable.php");
inc("/src/storage/StoresTable.php");
inc("/src/storage/ImportTable.php");
inc("/src/storage/ProductsTable.php");
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
	private $imports;
	private $products;

	private $crawler;
	private $params;

	private $tstart;
	private $tend;

	public function __construct(IDatabase $db, Logger $logger) {
		$this->db = $db;
		$this->logger = $logger;
		$this->campaigns = new CampaignsTable($db);
		$this->stores = new StoresTable($db);
		$this->plans = new CrawlPlanTable($db);
		$this->imports = new ImportTable($db);
		$this->products = new ProductsTable($db);
		$this->campaign = null;
		$this->store = null;
		$this->plan = null;
		$this->crawler = null;
		$this->params = null;
		$this->tstart = 0;
		$this->tend = 0;
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

	private function initImport() {

		$import = $this->imports->first([
			'campaign_id' => $this->campaign->id,
			'status' => 'ACTIVE'
		]);
		$this->tstart = microtime();
		if (!$import) {
			$import = (object) [
				'campaign_id' => $this->campaign->id,
				'status'      => 'ACTIVE',
				'expected'    => 0,
				'acquired'    => 0,
				'iduration'   => 0,
				'tduration'   => 0,
				'created'     => NEW DateTime("now"),
				'updated'     => null,
			];
			$this->imports->create($import);
		}
		$this->import = $import;
	}

	private function closeImport() {
		$nextPlan = $this->plans->first([
			'campaign_id' => $this->campaign->id,
			'status'      => 'PENDING',
		]);
		$this->tend = microtime();
		$this->import->iduration = $this->tend - $this->tstart;
		$this->import->updated   = new DateTime("now");
		if (!$nextPlan) {
			$this->import->status = 'INACTIVE'; 
		}
		$this->imports->update($this->import);
	}

	public function run() {
		$this->log("run");
		$this->initImport();
		$items = [];
		$acquired = 0;
		if ($this->plan) {
			$this->log("There is a plan, execute it");
			$items = $this->crawler->crawlPlan($this->plan, $this->params->itemsExp);
			$acquired = count($items);

			$this->plan->updated = new DateTime("now");
			$this->plan->status = 'EXECUTED';
			$this->plan->acquired = $acquired;
			
			$this->plans->update($this->plan);
		} else {
			$this->log("There is no plan. Create a new one");
			$items = $this->crawler->crawlFirstAndPlan(
				$this->campaign->url,
				$this->campaign->urltpl,
				$this->params->itemsExp,
				$this->params->pagerExp,
				$this->campaign->id
			);
			$acquired = count($items);
		}
		$expected = $this->crawler->getPageItemCount();

		$this->import->acquired = $this->import->acquired + $acquired;
		$this->import->expected = $this->import->expected + $expected;

		$this->save($items);
		$this->closeImport();
	}

	protected function save(&$items) {
		$table = $this->campaign->table;
		$this->products->setTable($table);
		foreach ($items as $item) {
			$product = $this->products->first(['_signature' => $item->_signature]);
			if ($product) {
				$product->_counter   = $product->_counter + 1;
				$product->_updated   = new DateTime("now");
				$product->_campaign_id = $this->campaign->id;
				$product->_import_id = $this->import->id;
				$this->products->update($product);
			} else {
				$item->_campaign_id = $this->campaign->id;
				$item->_import_id   = $this->import->id;
				$item->_counter     = 1;
				$item->_category    = $this->campaign->category;
				$item->_created     = new DateTime("now");
				$item->_updated     = null; 
				$this->products->create($item);
			}
		}
	}
}

?>