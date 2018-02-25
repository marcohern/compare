<?php
inc('/src/models/UpdatableEntity.php');

class LogEntry extends UpdatableEntity {

	public $message  = '';
	public $category = '';
	public $start    = null;
	public $end      = null;
	public $duration = 0;

}

?>