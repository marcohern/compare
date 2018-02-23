<?php
inc('/src/models/Entity.php');

class LogEntry extends Entity {

	public $message  = '';
	public $category = '';
	public $start    = null;
	public $end      = null;
	public $duration = 0;

}

?>