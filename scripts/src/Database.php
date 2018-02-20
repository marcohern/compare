<?php

class Database {
	private $mysqli;

	private $host;
	private $db;
	private $user;
	private $pwd;

	public function __construct() {
		$this->mysqli = null;
		$config = require('src/config/db.php');
		$this->host = $config['host'];
		$this->db   = $config['database'];
		$this->user = $config['user'];
		$this->pwd  = $config['password'];
	}

	public function connect() {
		$this->mysqli = new mysqli($this->host, $this->user, $this->pwd, $this->db);
		if ($this->mysqli->connect_error) {
			die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
		}

		if (!$this->mysqli->set_charset("utf8")) {
			die("Unable to set charset utf8: ".$this->mysqli->error);
		}
	}

	public function close() {
		$this->mysqli->close();
	}

	public function insert($table, &$record) {
		$data = [$record];
		$sql = $this->getInsertStmt($table, $data);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error INSERT: ".$this->mysqli->error);
		}	
	}

	public function insertMultiple($table, &$data) {
		$sql = $this->getInsertStmt($table, $data);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error INSERT MULTIPLE: ".$this->mysqli->error);
		}
	}

	public function update($table, $primkey, $id, &$record) {
		$sql = $this->getUpateStmt($table, $record, [$primkey => $id]);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error UPDATE: ".$this->mysqli->error);
		}	
	}

	public function updateMultiple($table, &$record, &$filters) {
		$sql = $this->getUpateStmt($table, $record, $filters);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error UPDATE MULTIPLE: ".$this->mysqli->error);
		}
	}

	public function selectSingle($table, $filters) {
		$sql = $this->getSimpleSelectStmt($table, $filters);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error SELECT SINGLE: ".$this->mysqli->error);
		}
		else
		{
			$result = $r->fetch_assoc();
			$r->close();
			return $result;
		}
	}

	public function getInsertStmt($table, &$data) {
		$sql = "INSERT INTO `$table` ";
		if (count($data) > 0) {
			$fld=0;
			foreach ($data[0] as $k => $v) {
				$sql .= (($fld==0) ? "(" : ",")."`$k`";
				$fld++;
			}
			$sql .= ") VALUES ";
			$r=0;
			foreach ($data as $row) {
				$fld=0;
				$sql .= ($r==0) ? '' : ',';
				foreach ($row as $v) {
					$sql .= ($fld==0) ? "(" : ",";
					$sql .= $this->getLiteral($v);
					$fld++;
				}
				$sql .= ')';
				$r++;
			}
		}
		$sql.=';';
		return $sql;
	}

	public function getUpateStmt($table, &$record, $filters) {
		$sql = "UPDATE `$table` ";
		$fld=0;
		foreach ($record as $k => $v) {
			$sql .= (($fld==0) ? " SET " : ", ")."`$k`".'='.$this->getLiteral($v);
			$fld++;
		}
		$sql .= " WHERE ";
		$fld=0;
		foreach($filters as $k => $v) {
			$sql .= (($fld==0) ? "" : " AND ")."`$k`".'='.$this->getLiteral($v);
			$fld++;
		}
		$sql.=';';
		return $sql;
	}

	public function getSimpleSelectStmt($table, &$filters) {
		$sql = "SELECT * FROM `$table` ";
		if (count($filters)>0) {
			$sql .= 'WHERE ';
			$fld=0;
			foreach($filters as $k => $v) {
				$sql .= (($fld==0) ? '' : ',')."`$k`=".$this->getLiteral($v);
				$fld++;
			}	
		}
		$sql.=';';
		return $sql;
	}

	protected function getLiteral($value) {
		if (is_null($value)) {
			return "NULL";
		}
		return "'".addslashes($value)."'";
	}
}
?>