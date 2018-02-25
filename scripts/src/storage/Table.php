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
		$result = $this->db->select(
			$this->table,
			$this->columns,
			$filters,
			$this->orderby
		);
		$r=[];
		foreach ($result as $item) {
			$r[] = (object) $item;
		}
		return $r;
	}

	public function first($filters) {
		$result = $this->db->select(
			$this->table,
			$this->columns,
			$filters,
			$this->orderby,
			1
		);
		if(array_key_exists(0, $result)) return (object) $result[0];
		else return null;
	}

	public function create(&$record) {
		$record->created = new DateTime("now");
		$arr = get_object_vars($record);
		$result = $this->db->insert($this->table, $arr);
		if ($result->id!=0) {
			$record->{$this->idkey} = $result->id;
		}
		return $record;
	}

	public function update(&$record) {
		$arr = get_object_vars($record);
		$this->db->update($this->table, $arr, [ $this->idkey => $record->{$this->idkey} ] );
		return $record;
	}

	public function save(&$record) {
		if (isset($record->{$this->idkey})) {
			return $this->update($record);
		} else {
			return $this->create($record);
		}
	}
}
?>