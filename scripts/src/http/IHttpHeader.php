<?php

interface IHttpHeader {
	public function readFromConfig();
	public function readFromArray(array &$arr);
	public function add($key, $value);
	public function get($key);
	public function dump();
	public function __toString();
}