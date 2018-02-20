<?php

class Stringer {
	public static function normalize($value) {
		$value = strtolower($value);
		$value = preg_replace('/[:;\.\-]/', '', $value);
		$value = preg_replace('/\s+/', ' ', $value);
		$value = trim($value);
		return $value;
	}

	public static function remove($value, array &$remove) {
		foreach($remove as $r) {
			$value = preg_replace($r, '', $value);
		}
		return $value;
	}

	public static function replace($value, array $replace) {
		foreach($replace as $from => $to) {
			$value = preg_replace($from, $to, $value);
		}
		return $value;
	}
}
?>