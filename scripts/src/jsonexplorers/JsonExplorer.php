<?php

inc('/src/jsonexplorers/IJsonExplorer.php');

abstract class JsonExplorer implements IJsonExplorer {
	private static $pathexp = '/([^\.]+)/';

	abstract public function explore(&$json);

	public function root(&$json, $path) {
		return $this->single($json, $path);
	}

	public function single(&$json, $path) {
		preg_match_all(self::$pathexp, $path, $matches);
		
		$element = $json;
		foreach ($matches[1] as $key) {
			if (is_array($element)) $element = $element[$key];
			else $element = $element->$key;
		}
		return $element;
	}
}

?>