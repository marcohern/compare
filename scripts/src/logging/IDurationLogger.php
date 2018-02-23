<?php

interface IDurationLogger {
	public function start($message,  $category = '*');
	public function end();
}
?>