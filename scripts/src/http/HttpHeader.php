<?php

inc("/src/http/HttpHeaderItem.php");
inc("/src/util/Stringer.php");
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

	public function merge(array &$items) {
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

	public function query(string $key, $pop = false) {
		$r = [];
		$indexes = [];
		foreach ($this->items as $i => $item) {
			if ($item->name === $key) {
				$r[] = $item;
				if ($pop) $indexes[] = $i;
			}
		}
		if ($pop) {
			foreach ($indexes as $i) {
				unset($this->items[$i]);
			}
		}
		return $r;
	}

	public function __get(string $name) {
		$header = Stringer::toHeaderKey($name);
		if (empty($header)) throw new HttpHeaderException("property '$name' has no equivalent header key.");
		$r = $this->merge($header);
		if (!$r) return null;
		return $r;
	}
}

?>