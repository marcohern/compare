<?php

function normalize_str($str) {
	$str = strtolower($str);
	$str = preg_replace('/[:;\-]/', '', $str);
	$str = preg_replace('/\s*/', ' ', $str);
	$str = trim($str);
	return $str;
}

function normalize_data(&$data, &$norm, &$remove, &$escape) {
	$n = count($data);
	for($i=0;$i<$n;$i++) {
		foreach ($remove as $c => $rems) {
			foreach ($rems as $r) {
				$data[$i][$c] = preg_replace($r, '', $data[$i][$c]);
			}
		}
		foreach($norm as $c) {
			$data[$i][$c] = normalize_str($data[$i][$c]);
		}
		foreach($escape as $c) {
			$data[$i][$c] = stripslashes($data[$i][$c]);
		}
	}
}

function read_content(&$content, &$exp, &$cols) {
	preg_match_all($exp, $content, $matches);
	$records = count($matches[0]);
	echo "..found $records items\n";
	$result = [];
	for ($i=0;$i<$records;$i++) {
		$r = [];
		foreach ($cols as $c) {
			$r[$c] = $matches[$c][$i];
		}
		$result[] = $r;
	}
	return $result;
}

function read_paging(&$content, &$exp) {
	preg_match($exp, $content, $matches);
	
}

function read_page($urltpl, &$exp, $cols, $norm, $remove, $escape, $offset=0, $limit=10, $p0=0, $p1=1) {
	$url = $urltpl;
	$url = preg_replace('/\[limit\]/' , $limit , $url);
	$url = preg_replace('/\[offset\]/', $offset, $url);
	$url = preg_replace('/\[p0\]/'    , $p0    , $url);
	$url = preg_replace('/\[p1\]/'    , $p1    , $url);
	echo "$url\n";

	$content = file_get_contents($url);
	$results = read_content($content, $exp, $cols);
	normalize_data($results, $norm, $remove, $escape);
	
	return $results;
}
?>