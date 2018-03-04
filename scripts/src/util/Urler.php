<?php

class Urler {

	public static $urlexp = '/^(((?<protocol>[^:]+):)?\/\/(?<host>[^\/]+))?((?<path>\/?[^\?]*\/?)(\?(?<query>[^#]*))?(#(?<anchor>.*))?)?$/';
	public static $queryexp = '/&?((?<key>[^=]+)=)?(?<value>[^&]+)/';
	public static $pathexp = '/(\/?(?<folder>[^\/]+))/';
	public static $hostexp = '/((?<name>[^\.]*)\.)?(?<domain>.+\..+)/';

	protected static function explodeQuery($query) {
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
		if (!$r) return [];
		return $matches['folder'];
	}

	protected static function explodeHost($host) {
		$r = preg_match(self::$hostexp, $host, $matches);
		if (!$r) return null;
		return (object) [
			'name' => $matches['name'],
			'domain' => $matches['domain'],
		];
	}

	public static function explode($url) {
		$r = preg_match(self::$urlexp, $url, $match);
		if (!$r) return null;
		$result = new stdClass();
		$result->url = $url;
		$result->protocol   = array_key_exists('protocol', $match) ? $match['protocol'] : '';
		$result->host       = array_key_exists('host', $match) ? $match['host'] : '';
		$result->name = '';
		$result->domain = '';
		$hostparts = self::explodeHost($result->host);
		if (!empty($hostparts)) {
			$result->name = $hostparts->name;
			$result->domain = $hostparts->domain;
		}
		$result->path       = array_key_exists('path', $match) ? $match['path'] : '';
		$result->pathItems  = self::explodePath($result->path);
		$result->query      = array_key_exists('query', $match) ? $match['query'] : '';
		$result->queryItems = self::explodeQuery($result->query);
		$result->anchor     = array_key_exists('anchor', $match) ? $match['anchor'] : '';
		return $result;
	} 
}
?>