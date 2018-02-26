<?php

inc('/src/jsonexplorers/IJsonExplorer.php');

class JsonExplorer implements IJsonExplorer {
	private static $pathexp = '/([^\.]+)/';
	private $json;
	private $root;

	public function __construct(&$json) {
		$this->json = $json;
		$this->root = $json;
	}

	public function explore() {

	}

	public function setRoot($path) {
		$this->root = $this->single($path);
	}

	public function single($path) {
		preg_match_all(self::$pathexp, $path, $matches);
		
		$element = $this->root;
		foreach ($matches[1] as $key) {
			if (is_array($element)) $element = $element[$key];
			else $element = $element->$key;
		}
		return $element;
	}
}

?>