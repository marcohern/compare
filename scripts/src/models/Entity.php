<?php

class Entity {

	public $id;
	public $created;

	public function __construct() {
		$this->id = null;
		$this->created = new DateTime("now");
	}
}
?>