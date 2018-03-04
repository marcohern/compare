<?php

inc("/src/http/HttpWeighted.php");
inc("/src/http/HttpVar.php");

class HttpHeaderItem {
	private static $vars = [
		'cookie',
		'set-cookie'
	];
	
	private static $weighted = [
		'accept',
		'accept-language',
		'accept-encoding'
	];

	private static $exp = '/(\s*(?<name>[^:]+):)?(\s*(?<value>.+(\r\n)?))/';

	public $name;
	public $value;

	public function __construct($name = '', $value = '') {
		$this->name = strtolower($name);
		$this->value = $value;
	}

	private function stringify(&$source) {
		if (is_array($source)) {
			$n = count($source);
			if ($n > 0) {
				if (is_a($source[0], 'HttpVar'))      return HttpVar::join($source);
				if (is_a($source[0], 'HttpWeighted')) return HttpWeighted::join($source);
			}
			return '';
		}
		return $source;
	}

	public function __toString() {
		if (empty($this->name)) {
			if (empty($this->value)) return '';
			return $this->value;
		}
		return "{$this->name}: ".$this->stringify($this->value);
	}

	public static function parse($source) {
		$result = [];
		$r = preg_match_all(self::$exp, $source, $m);
		if (!$r) return $result;
		$n = count($m[0]);
		for ($i=0; $i<$n; $i++) {
			$var = new HttpHeaderItem();
			$var->name = strtolower($m['name'][$i]);
			if (in_array($var->name, self::$vars)) {
				$var->value = HttpVar::parse($m['value'][$i]);	
			}
			else if (in_array($var->name, self::$weighted)) {
				$var->value = HttpWeighted::parse($m['value'][$i]);	
			}
			else $var->value = $m['value'][$i];
			$result[] = $var;
		}
		return $result;
	}

	public static function join(array $list) {
		$s = '';
		foreach ($list as $v) {
			if (!empty($s)) $s .= "\r\n";
			$s .= $v;
		}
		return $s;
	}
}
?>