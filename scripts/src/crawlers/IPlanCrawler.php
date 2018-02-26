<?php

interface IPlanCrawler {

	public function crawlFirstAndPlan($url, $urltpl, &$itemExp, &$pagingExp);
	public function crawlPlan(&$plan, &$exp);
}
?>