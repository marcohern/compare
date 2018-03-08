<?php

class HttpWeighted {
	private static $exp = '/\s*(?<value>[^,;]+)(;\s*q=(?<q>[^,]+))?/';

	public $value;
	public $q;

	public function __construct($value = '', $q = 1.0) {
		$this->value = $value;
		$this->q = $q;
	}

	public function __toString() {
		if ($this->q>=1.0) {
			if (empty($this->value)) return '';
			return $this->value;
		}
		return "{$this->value};q={$this->q}";
	}

	public static function parse($source) {
		$result = [];
		$r = preg_match_all(self::$exp, $source, $m);
		if (!$r) return $result;
		$n = count($m[0]);
		for ($i=0; $i<$n; $i++) {
			$weight = new HttpWeighted();
			$weight->value = $m['value'][$i];
			$weight->q = (empty($m['q'][$i])) ? 1 : 0+$m['q'][$i];
			$result[$weight->value] = $weight;
		}
		return $result;
	}

	public static function join(array $list) {
		$s = '';
		foreach ($list as $v) {
			if (!empty($s)) $s .= ', ';
			$s .= $v;
		}
		return $s;
	}
}

?>