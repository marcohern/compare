<?php

/**
 * Simple MySQL database access layer
 */
class Database {
	private $mysqli; //MySQLi resource

	private $host; //Database host name
	private $db;   //Database name
	private $user; //username
	private $pwd;  //password
	private $charset;  //charset

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->mysqli = null;
		$config = require('src/config/db.php');
		$this->host = $config['host'];
		$this->db   = $config['database'];
		$this->user = $config['user'];
		$this->pwd  = $config['password'];
		$this->charset  = $config['charset'];
	}

	/**
	 * Connect to database
	 */
	public function connect() {
		$this->mysqli = new mysqli($this->host, $this->user, $this->pwd, $this->db);
		if ($this->mysqli->connect_error) {
			die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
		}

		if (!$this->mysqli->set_charset($this->charset)) {
			die("Unable to set charset {$this->charset}: ".$this->mysqli->error);
		}
	}

	/**
	 * Close a currently open connection
	 */
	public function close() {
		$this->mysqli->close();
	}

	/**
	 * Insert a record into a table.
	 */
	public function insert($table, &$record) {
		$data = [$record];
		$sql = $this->getInsertStmt($table, $data);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error INSERT: ".$this->mysqli->error);
		}	
	}

	/**
	 * Insert multiple records into a table
	 */
	public function insertMultiple($table, &$data) {
		$sql = $this->getInsertStmt($table, $data);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error INSERT MULTIPLE: ".$this->mysqli->error);
		}
	}

	/**
	 * update a single record of a table
	 */
	public function update($table, $primkey, $id, &$record) {
		$sql = $this->getUpateStmt($table, $record, [$primkey => $id]);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error UPDATE: ".$this->mysqli->error);
		}	
	}

	/**
	 * update multiple records of a table
	 */
	public function updateMultiple($table, &$record, &$filters) {
		$sql = $this->getUpateStmt($table, $record, $filters);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error UPDATE MULTIPLE: ".$this->mysqli->error);
		}
	}

	/**
	 * select a single record
	 */
	public function selectSingle($table, $filters) {
		$sql = $this->getSimpleSelectStmt($table, $filters);
		$r = $this->mysqli->query($sql);
		if (!$r) {
			die("Error SELECT SINGLE: ".$this->mysqli->error." $sql");
		}
		else
		{
			$result = $r->fetch_assoc();
			$r->close();
			return $result;
		}
	}

	/**
	 * build an SQL INSERT Statement with multiple records
	 */
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

	/**
	 * build an SQL UPDATE Statement
	 */
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

	/**
	 * build a simple SQL SELECT Statement
	 */
	public function getSimpleSelectStmt($table, &$filters) {
		$sql = "SELECT * FROM `$table` ";
		if (count($filters)>0) {
			$sql .= 'WHERE ';
			$fld=0;
			foreach($filters as $k => $v) {
				$sql .= (($fld==0) ? '' : ' AND ')."`$k`=".$this->getLiteral($v);
				$fld++;
			}	
		}
		$sql.=';';
		return $sql;
	}

	/**
	 * return a literal value.
	 */
	protected function getLiteral($value) {
		if (is_null($value)) {
			return "NULL";
		}
		return "'".addslashes($value)."'";
	}
}
?>