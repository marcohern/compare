<?php

inc('/src/http/IHttpHeader.php');

class HttpHeader implements IHttpHeader {

	static private $hedexp = '/^((?<key>[^:]+):)?\s*(?<value>.*)$/';
	static private $varexp = '/((?<key>[^=]+)=)?\s*(?<value>[^;]+);?/';
	static private $grpexp = '/,?(?<group>[^,]+)/';

	static private $variables = ['cookie','set-cookie'];
	static private $groups = ['accept-language'];
	private $keys = [];

	public function readFromConfig() {
		$this->keys = read('/src/config/http_headers.php');
	}

	protected function explodeValue(&$kkey, &$value) {
		$result = [];
		if (in_array($kkey, self::$variables)) {
			$r = preg_match_all(self::$varexp, $value, $matches);
			if (!$r) return '';
			$n = count($matches[0]);

			for ($i=0; $i<$n; $i++) {
				$key   = $matches['key'][$i];
				$value = $matches['value'][$i];
				if (empty($key)) $result[] = $value;
				else $result[$key] = $value;
			}
		} else if (in_array($kkey, self::$groups)) {
			$r = preg_match_all(self::$grpexp, $value, $matches);
			if (!$r) return '';
			for ($i=0; $i<$n; $i++) {
				$group = $matches['group'][$i];
				$grpa = [];
				$s = preg_match_all(self::$varexp, $group, $gm);
				if (!$s) break;
				$m = count($gm[0]);
				for ($j=0; $j<$m; $j++) {
					$key   = $matches['key'][$i];
					$value = $matches['value'][$i];
					if (empty($key)) $grpa[] = $value;
					else $grpa[$key] = $value;
				}
				$result[] = $grpa;
			}
		} else {
			return $value;
		}
		return $result;
	} 

	public function readFromArray(array &$arr) {
		foreach ($arr as $v) {
			preg_match(self::$hedexp, $v, $match);
			if (empty($match['key'])) {
				$this->keys[] = $match['value'];
			} else {
				$key = strtolower($match['key']);
				$this->keys[$key] = $this->explodeValue($key, $match['value']);
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

	public function set($key, $value) {
		$this->keys[$key] = $value;
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