<?php

inc("/src/models/Entity.php");
inc("/src/database/IDatabase.php");
inc("/src/exceptions/DatabaseNotFoundException.php");

class Table {

	private $db;
	private $table;
	private $idkey;

	public function __construct($table, IDatabase $db) {
		$this->table = $table;
		$this->db = $db;
		$this->idkey = 'id';
	}

	public function setIdKey($idkey) {
		$this->idkey = $idkey;
	}

	public function getById($id) {
		$records = $this->db->select($this->table, null, [$this->idkey => $id]);
		if (count($records) > 0) {
			return $records[0];
		}
		throw new DatabaseNotFoundException("Record in '{$this->table}' with '{$this->idkey}' = '$id' not found.");
	}
}
?>