<?php

interface IPlanCrawler {

	public function crawlFirstAndPlan($url, $urltpl, &$itemExp, &$pagingExp, $campaign_id);
	public function crawlPlan(&$plan, &$exp);
}
?>