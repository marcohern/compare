<?php

class HttpVar {
	private static $exp = '/(\s*(?<name>[^=]+)=)?\s*(?<value>[^;]+);?/';

	public $name;
	public $value;

	public function __construct($name = '', $value = '') {
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString() {
		if (empty($this->name)) {
			if (empty($this->value)) return '';
			return $this->value;
		}
		return "{$this->name}={$this->value}";
	}

	public static function parse(string &$source) {
		$result = [];
		$r = preg_match_all(self::$exp, $source, $m);
		if (!$r) return $result;
		$n = count($m[0]);
		for ($i=0; $i<$n; $i++) {
			$var = new HttpVar();
			$var->name = $m['name'][$i];
			$var->value = $m['value'][$i];
			if(empty($var->name)) $result[] = $var;
			else $result[$var->name] = $var;
		}
		return $result;
	}

	public static function join(array &$list) {
		$s = '';
		foreach ($list as $v) {
			if (!empty($s)) $s .= '; ';
			$s .= $v;
		}
		return $s;
	}

	public static function merge(array &$vars1, array &$vars2) {
		return array_merge($vars1, $vars2);
	}
}

?>