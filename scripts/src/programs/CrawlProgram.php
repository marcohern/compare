<?php

inc('/src/logging/CmdLogger.php');
inc('/src/programs/Program.php');

class CrawlProgram extends Program {
	private $campaignCodes = [
		'ALK-PS4-GAMES',
		'AKO-PS4-GAMES',
		'KTR-PS4-GAMES',
		'FLB-PS4-GAMES',
		'EXT-PS4-GAMES'
	];

	protected function execute() {
		$n = count($this->campaignCodes);
		$rand = rand(0,$n-1);
		$code = $this->campaignCodes[$rand];

		$campaign = $this->campaigns->first(['code' => $code]);


		$class = $campaign->executor;
		inc("/src/executors/$class.php");
		$this->log($code);
		$exe = new $class($this->db, $this->logger);
		$exe->init($campaign);
		$exe->run();
	}
}

?>