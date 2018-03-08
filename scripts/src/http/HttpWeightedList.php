<?php

inc('/src/http/HttpWeighted.php');

class HttpWeightedList {
	private $w;
	private $cnt;

	public function __construct() {
		$this->w = [];
		$this->cnt = 0;
	}

	public function set(HttpWeighted $weighted) {
		$this->w[$weighted->value] = $weighted;
		$this->cnt = count($this->w);
	}

	public function setWeight(string $value, float $q) {
		if (array_key_exists($value, $this->w)) {
			$this->w[$value]->q = $q;
		} else {
			$this->w[$value] = new HttpWeighted($value, $q);
		}
	}

	public function get(string $value) {
		if (array_key_exists($value, $this->w)) {
			return $this->w[$value];
		}
		return null;
	}

	public function getAll() {
		return $this->w;
	}

	public function setWeights(array $weights) {
		foreach ($weights as $k => $v) {
			if (is_a($v, HttpWeighted::class)) {
				$this->set($v);
			} else {
				$value = $v[0];
				$q = $v['q'];
				$this->setWeight($value, $q);
			}
		}
	}

	public function __toString() {
		return HttpWeighted::join($this->w);
	}

	public function parse(string $source) {
		$w = HttpWeighted::parse($source);
		foreach ($w as $v) {
			$this->set($v);
		}
	}
}
?>