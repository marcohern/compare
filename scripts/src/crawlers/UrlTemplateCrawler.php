<?php

inc("/src/crawlers/IPagingTemplateUrl.php");
inc("/src/crawlers/PageStateCrawler.php");
inc("/src/crawlers/ColumnContainer.php");
inc("/src/logging/Logger.php");

class UrlTemplateCrawler extends PageStateCrawler implements IPagingTemplateUrl {

	private static $rppExp    = '/\[(rowsPerPage|rpp|r|limit|l)\]/i';
	private static $offsetExp = '/\[(startRow|s|offset|o)\]/i';
	private static $page0Exp  = '/\[(ZeroBasePage|p0)\]/i';
	private static $page1Exp  = '/\[(OneBasePage|p1)\]/i';

	public function __construct(ColumnContainer $cc, Logger $logger = null) {
		parent::__construct($cc, $logger);
	}

	public function getPageUrl($urltpl) {
		$url = $urltpl;
		$url = preg_replace(self::$rppExp   , $this->getRpp()     , $url);
		$url = preg_replace(self::$offsetExp, $this->getOffset()  , $url);
		$url = preg_replace(self::$page0Exp , $this->getPage()    , $url);
		$url = preg_replace(self::$page1Exp , $this->getPage() + 1, $url);
		return $url;
	}
}
?>