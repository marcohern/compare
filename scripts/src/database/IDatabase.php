<?php

interface IDatabase {
	public function connect();
	public function close();
	public function version();
}

?>