<?php

inc('/src/http/IHttpHeader.php');

class HttpHeader implements IHttpHeader {
	private $keys = [];

	public function readFromConfig() {
		$this->keys = read('/src/config/http_headers.php');
	}

	public function readFromArray(array &$arr) {
		$exp = '/^((?<key>[^:]+):)?\s*(?<value>.*)$/';
		foreach ($arr as $v) {
			preg_match($exp, $v, $match);
			var_dump($match);
			if (empty($match['key'])) {
				$this->keys[] = $match['value'];
			} else {
				$this->keys[$match['key']] = $match['value'];
			}
		} 
	}

	public function add($key, $value = null) {
		if (is_null($value)) {
			$this->keys[] = $key;
		} else {
			$this->keys[] = [$key => $value];
		}
	}

	public function get($key) {
		if (array_key_exists($key, $this->keys)) {
			return $this->keys[$key];
		}
		return null;
	}

	public function dump() {
		var_dump($this->keys);
	} 

	public function renderSub(&$value, $sep = ',') {
		if (is_array($value)) {
			$str = '';
			foreach ($value as $k => $v) {
				if (!empty($str)) $str .= $sep; 
				if (is_int($k)) {
					$str .= $this->renderSub($v,';');
				} else {
					$str .= "$k=".$this->renderSub($v,';');
				}
			}
			return $str;
		}
		else return $value;
	}

	protected function isVariableList($key) {
		echo "isVariableList $key\n";
		if (preg_match('/cookie/i',$key)) {
			return true;
		}
		return false;
	}

	protected function render() {
		$str = '';
		foreach ($this->keys as $k => $v) {
			if (is_array($v)) {
				if (is_int($k)) {
					$str .= $this->renderSub($v)."\r\n";
				} else {
					$str .= "$k: ";
					if ($this->isVariableList($k)) $str.= $this->renderSub($v,'; ')."\r\n";
					else $str .= $this->renderSub($v)."\r\n";
				}
			} else {
				if (is_int($k)) {
					$str.= $this->renderSub($v)."\r\n";
				} else {
					$str.= "$k: ".$this->renderSub($v)."\r\n";
				}
			}
		}
		return $str;
	}

	public function __toString() {
		return $this->render();
	}
} 
?>