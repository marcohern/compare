<?php

inc("/src/database/IDatabase.php");
inc("/src/exceptions/DatabaseNotFoundException.php");

class Table {

	private $db;

	protected $table;
	protected $idkey;
	protected $columns;
	protected $orderby;

	public function __construct($table, IDatabase $db) {
		$this->db      = $db;
		$this->table   = $table;
		$this->idkey   = 'id';
		$this->columns = null;
		$this->orderby = null;
	}

	public function setIdKey($idkey) {
		$this->idkey = $idkey;
	}

	public function getById($id) {
		$records = $this->db->select(
			$this->table,
			$this->columns,
			[$this->idkey => $id],
			$this->orderby
		);
		if (count($records) > 0) {
			return $records[0];
		}
		throw new DatabaseNotFoundException("Record in '{$this->table}' with '{$this->idkey}' = '$id' not found.");
	}

	public function find($filters) {
		return $this->db->select(
			$this->table,
			$this->columns,
			$filters,
			$this->orderby
		);
	}
}
?>