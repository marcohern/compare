<?php

inc("/src/exceptions/DatabaseException.php");
inc("/src/database/mysql/MySqlQueryBuilder.php");
inc("/src/database/SqlConstants.php");
inc("/src/database/IDatabase.php");

class MySqlDatabase implements IDatabase {
	private $mi;       //MySQLi Resource

	private $host;     //Database host name
	private $db;       //Database name
	private $user;     //username
	private $pwd;      //password
	private $charset;  //charset
	private $sqlb;     //MySQL Query Builder

	public function __construct() {
		$config        = read('/src/config/db.php');
		$this->host    = $config['host'];
		$this->db      = $config['database'];
		$this->user    = $config['user'];
		$this->pwd     = $config['password'];
		$this->charset = $config['charset'];
		$this->sqlb    = new MySqlQueryBuilder();
	}

	public function connect() {
		$this->mi = new mysqli($this->host, $this->user, $this->pwd, $this->db);
		if ($this->mi->connect_error) {
			die('Connect Error (' . $this->mi->connect_errno . ') ' . $this->mi->connect_error);
		}

		if (!$this->mi->set_charset($this->charset)) {
			die("Unable to set charset {$this->charset}: ".$this->mi->error);
		}
	}

	public function version() {
		$r = $this->mi->query("SELECT @@VERSION AS version");
		if ($r) {
			$d = $r->fetch_assoc();
			return $d['version'];
		}
		return null;
	}

	public function close() {
		$this->mi->close();
	}

	public function select($table, $columns = null, array $filters = null, array $orderby = null) {
		$sql = $this->sqlb->select($table, $column, $filters, $orderby);
		$rows = [];
		$r = $this->mi->query($sql);
		if ($r) while ($item = $r->fetch_assoc()) {
			$rows[] = (object)$item;
		}
		$r->close();
		return $rows;
	}

	public function insert($table, array &$data = null) {
		$sql = $this->sqlb->insert($table, $data);
		$r = $this->mi->query($sql);
		if ($r) {
			$r = $this->mi->query("SELECT LAST_INSERT_ID() as id");
			if ($r) {
				$id = $r->fetch_assoc()['id'];

				$result = new stdClass();
				$result->created = $this->mi->affected_rows;
				$result->id = 0+$id;
				return $result;
			}
		}
		throw new DatabaseException("INSERT ERROR: ".$this->mi->error);
	}

	public function update($table, array &$record, array $filters = null) {
		$sql = $this->sqlb->update($table, $record, $filters);
		$r = $this->mi->query($sql);
		$affected = 0;
		if ($r) {
			return $this->mi->affected_rows;
		}
		throw new DatabaseException("UPDATE ERROR: ".$this->mi->error);
	}

	public function delete($table, array $filters = null) {
		$sql = $this->sqlb->delete($table, $filters);
		$r = $this->mi->query($sql);
		$affected = 0;
		if ($r) {
			return $this->mi->affected_rows;
		}
		throw new DatabaseException("DELETE ERROR: ".$this->mi->error);

	}
}

?>