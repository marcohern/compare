<?php

class Stringer {
	public static $urlexp = '/^(((?<protocol>[^:]+):)?\/\/(?<host>[^\/]+))?((?<path>\/[^\?]*)(\?(?<query>[^#]*))?(#(?<anchor>.*))?)?$/';
	public static $queryexp = '/&?((?<key>[^=]+)=)?(?<value>[^&]*)/';
	public static $pathexp = '/\/?(\/(?<folder>[^\/]*))/';

	public static function normalize($value) {
		$value = strtolower($value);
		$value = preg_replace('/[:;\-]/', '', $value);
		$value = preg_replace('/\s+/', ' ', $value);
		$value = trim($value);
		return $value;
	}

	public static function remove($value, array &$remove) {
		foreach($remove as $r) {
			$value = preg_replace($r, '', $value);
		}
		return $value;
	}

	public static function replace($value, array $replace) {
		foreach($replace as $from => $to) {
			$value = preg_replace($from, $to, $value);
		}
		return $value;
	}

	protected static function explodeUrlQuery($query) {
		$r = preg_match_all(self::$queryexp, $query, $matches);
		if (!$r) return [];
		$result = [];
		$n = count($matches[0]);
		for ($i=0; $i<$n; $i++) {
			$key = $matches['key'][$i];
			$value = $matches['value'][$i];
			$r = [];
			if (empty($key)) $r = $value;
			else $r[$key] = $value;
			$result[] = $r;
		}
		return $result;
	}

	protected static function explodePath($path) {
		$r = preg_match_all(self::$pathexp, $path, $matches);
		//var_dump($matches);die("fornow");
		if (!$r) return [];
		return $matches['folder'];
	}

	public static function explodeUrl($url) {
		$r = preg_match(self::$urlexp, $url, $match);
		if (!$r) return null;
		$result = new stdClass();
		$result->protocol = $match['protocol'];
		$result->host = $match['host'];
		$result->path = $match['path'];
		$result->pathItems = self::explodePath($result->path);
		$result->queryStr = array_key_exists('query', $match) ? $match['query'] : '';
		$result->query = self::explodeUrlQuery($result->queryStr);
		$result->anchor = array_key_exists('anchor', $match) ? $match['anchor'] : '';
		return $result;
	} 
}
?>