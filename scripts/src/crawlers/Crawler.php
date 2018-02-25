<?php

inc("/src/crawlers/ICrawler.php");

class Crawler implements ICrawler {

	private $charset;

	public function __construct() {
		$this->charset = 'UTF-8';
	}

	public function crawl($url, &$exp) {
		$content = mb_convert_encoding(file_get_contents($url),$this->charset);
		$matches = [];
		$r = preg_match_all($exp, $content, $matches);
		$items = [];
		if ($r !== false) {
			$n = count($matches[0]);
			for($i=0;$i<$n;$i++) {
				$items[$i] = new stdClass();
				foreach($matches as $c => $v) {
					if (is_string($c))
						$items[$i]->$c = $matches[$c][$i];
				}
			}
		}
		return $items;
	}
}

?>