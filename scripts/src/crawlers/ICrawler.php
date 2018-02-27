<?php

interface ICrawler {
	public function crawl($url, &$exp);
	public function setContext($context);
}
?>