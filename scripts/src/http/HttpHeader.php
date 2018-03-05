<?php

inc("/src/http/HttpHeaderItem.php");
inc("/src/exceptions/HttpHeaderException.php");

class HttpHeader {
	private $items = [];

	public function __construct($source) {
		$this->items = self::parse($source);
	}

	public static function parse($source) {
		if (is_array($source)) {
			$headers = [];
			foreach ($source as $s) {
				$items = HttpHeaderItem::parse($s);
				$headers = array_merge($headers, $items);
			}
			return $headers;
		}
		return HttpHeaderItem::parse($source);
	}

	public function __toString() {
		return HttpHeaderItem::join($this->items);
	}

	private function toHeaderKey($name) {
		$r = preg_match_all('/(?<p>(?<letter>[A-Z]?)(?<word>[^A-Z]+))/', $name, $m);
		if (!$r) return null;
		$n = count($m[0]);
		$key = $m['p'][0];
		for ($i=1; $i<$n; $i++) {
			$key .= '-'.strtolower($m['letter'][$i]).$m['word'][$i];
		}
		return $key;
	}

	public function query($key) {
		$r = [];
		foreach ($this->items as $item) {
			if ($item->name === $key) {
				$r[] = $item;
			}
		}
		return $r;
	}

	public function mergeVariables($key) {
		$items = $this->query($key);
		$result = [];
		$n = count($items);
		if ($n>0) {
			$result = $items[0];
			for ($i=1; $i<$n; $i++) {
				$result->value = array_merge($result->value, $items[$i]->value);
			}
		}
		return $result;
	}

	public function __get(string $name) {
		$header = $this->toHeaderKey($name);
		if (empty($header)) throw new HttpHeaderException("property '$name' has no equivalent header key.");
		$r = $this->query($header);
		if (empty($r)) throw new HttpHeaderException("key '$header' ($name) not found.");
		$r = $this->mergeVariables($header);
		return $r;
	}
}

?>