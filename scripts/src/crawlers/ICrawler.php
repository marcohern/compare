<?php

interface ICrawler {
	public function crawl($url, &$exp);
}
?>