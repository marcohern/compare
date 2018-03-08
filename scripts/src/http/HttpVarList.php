<?php

inc('/src/http/HttpVar.php');

class HttpVarList {
	private $vars;
	private $cnt;

	public function __construct() {
		$this->vars = [];
		$this->cnt = 0;
	}

	public function set(HttpVar $var) {
		if (empty($var->name)) $this->vars[] = $var;
		else $this->vars[$var->name] = $var;
		$this->cnt = count($this->vars);
	}

	public function setValue(string $name,  $value) {
		$var =  new HttpVar($name, $value);
		$this->set($var);
	}

	public function get(string $name) {
		if (array_key_exists($name, $this->vars)) {
			return $this->vars[$name];
		}
		return null;
	}

	public function getValue(string $name) {
		$var = $this->get($name);
		if (!is_null($var)) return $var->value;
		return null;
	}

	public function getAll() {
		return $this->vars;
	}

	public function setVars(array $vars) {
		foreach ($vars as $k => $v) {
			if (is_a($v, HttpVar::class)) {
				$this->set($k, $v->value);
			} else {
				$this->setValue($k, $v);
			}
		}
	}

	public function __toString() {
		return HttpVar::join($this->vars);
	}

	public function parse(string $source) {
		$vars = HttpVar::parse($source);
		foreach ($vars as $k =>  $v) {
			$this->set($v);
		}
		$this->cnt = count($this->vars);
	}
}
?>