<?php

interface IExecutor {
	public function init(&$campaign);
	public function run();
}
?>