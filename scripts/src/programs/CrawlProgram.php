<?php

inc('/src/logging/CmdLogger.php');
inc('/src/programs/Program.php');

class CrawlProgram extends Program {
	protected function execute() {
		$this->log("Hello World");
	}
}

?>