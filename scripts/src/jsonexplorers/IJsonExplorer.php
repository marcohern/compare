<?php

interface IJsonExplorer {
	public function explore();
	public function setRoot($path);
	public function single($path);
}

?>