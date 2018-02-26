<?php

interface IJsonExplorer {
	public function explore(&$json);
	public function root(&$json, $path);
	public function single(&$json, $path);
}

?>