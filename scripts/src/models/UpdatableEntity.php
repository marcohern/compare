<?php

inc('/src/models/Entity.php');

class UpdatableEntity extends Entity {
	
	public $updated;

	public function __construct() {
		$this->updated = null;
	}

	public function update() {
		$this->updated = new  DateTime("now");
	}
}

?>