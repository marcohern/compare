<?php

interface IDatabase {
	public function connect();
	public function close();
	public function version();

	public function select($table, $columns = null, array $filters = null, array $orderby = null);
	public function insert($table, array $data = null);
	public function update($table, array &$record, array &$filters = null);
	public function delete($table, array &$filters = null);
}

?>