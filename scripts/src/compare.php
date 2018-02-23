<?php

define('ROOT',dirname(dirname(__FILE__)));

function inc($file) {
	return require_once(ROOT.$file);
}

function read($file) {
	return include(ROOT.$file);
}

?>