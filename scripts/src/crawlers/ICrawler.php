<?php

interface ICrawler {
	public function crawl($url, &$exp);
	public function crawlContent($content, &$exp);
	public function setContext($context);
}
?>