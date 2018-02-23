<?php

class Entity {
	public $id;

	public $created;
	public $updated;

	public function __construct() {
		$this->id = null;
		$this->created = new DateTime("now");
		$this->updated = null;
	}

	public function update() {
		$this->updated = new  DateTime("now");
	}
}
?>