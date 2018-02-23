<?php

class SqlQueryBuilder {

	private function getLiteral(&$value) {
		if (is_null($value)) {
			return "NULL";
		}
		if (is_a($value, '\DateTime')) {
			return "'".$value->format("Y-m-d H:i:s")."'";
		}
		if (is_string($value)) {
			return "'".addslashes($value)."'";
		}
		if (is_numeric($value)) {
			return $value;
		}
		return "'".addslashes($value)."'";
	}

	private function getIdentityName(&$identity) {
		return "`$identity`";
	}

	private function getOrderByColumns(&$columns) {
		$i = 0;
		$sql = '';
		foreach($columns as $k => $v) {
			$sql .= ($i===0) ? '' : ',';
			if (is_int($k)) $sql .= $this->getIdentityName($v).' ASC';
			else $sql .= $this->getIdentityName($k).' '.$v;
			$i++;
		}
		return $sql;
	}

	private function getKeysAsColumns(&$record) {
		$i = 0;
		$sql = '';
		foreach($record as $k => $v) {
			$sql .= ($i===0) ? '' : ',';
			$sql .= $this->getIdentityName($k);
			$i++;
		}
		return $sql;
	}

	private function getRecordLiteralValues(&$record) {
		$i = 0;
		$sql = '';
		foreach($record as $v) {
			$sql .= ($i===0) ? '' : ',';
			$sql .= $this->getLiteral($v);
			$i++;
		}
		return $sql;
	}

	private function getTableLiteralValues(&$table) {
		$i = 0;
		$sql = '';
		foreach ($table as $r) {
			$sql .= ($i===0) ? '' : ',';
			$sql .= "(".$this->getRecordLiteralValues($r).")";
			$i++;
		} 
		return $sql;
	}

	private function getAliasedColumns(&$columns) {
		$i = 0;
		$sql = '';
		foreach($columns as $k => $v) {
			$sql .= ($i===0) ? '' : ',';
			if (is_int($k)) $sql .= $this->getIdentityName($v);
			else $sql .= "$v AS ".$this->getIdentityName($k);
			$i++;
		}
		return $sql;
	}

	private function getSetters(&$record) {
		$i = 0;
		$sql = '';
		foreach($record as $k => $v) {
			$sql .= ($i===0) ? '' : ', ';
			$sql .= $this->getIdentityName($k)." = ".$this->getLiteral($v);
			$i++;
		}
		return $sql;
	}

	private function getItemsAsFilters(&$filters) {
		$i = 0;
		$sql = '';
		foreach($filters as $k => $v) {
			$sql .= ($i===0) ? '' : ' AND ';
			$sql .= $this->getIdentityName($k)." = ".$this->getLiteral($v);
			$i++;
		}
		return $sql;
	}

	public function select($table, $filters = null, $columns = null, $order = null) {
		$sql = "SELECT ";
		if (is_array($columns)) $sql .= $this->getAliasedColumns($columns);
		else if (empty($columns)) $sql .= '*';
		else $sql.=$columns;
		$sql .= " FROM `$table`";
		if (!empty($filters)) {
			$sql .= ' WHERE '.$this->getItemsAsFilters($filters);
		}
		if (!empty($order)) {
			$sql .= ' ORDER BY '.$this->getOrderByColumns($order);
		}
		return $sql;
	}

	public function insert($table, &$data) {
		$sql = "INSERT INTO ".$this->getIdentityName($table);
		$values = '';
		$columns = '';
		if (is_array($data)) {
			if (array_key_exists(0, $data)) {
				$columns = "(".$this->getKeysAsColumns($data[0]).")";
				$values = $this->getTableLiteralValues($data);
			}
			else {
				$columns = "(".$this->getKeysAsColumns($data).")";
				$values  = "(".$this->getRecordLiteralValues($data).")";
			}
		} else {
			$values = $this->getLiteral($data);
		}
		$sql .= "$columns VALUES $values;";
		return $sql;
	}

	public function delete($table, $filters) {
		$sql = "DELETE FROM ".$this->getIdentityName($table)." WHERE ".$this->getItemsAsFilters($filters).';';
		return $sql;
	}

	public function update($table, $record, $filters) {
		$sql = "UPDATE ".$this->getIdentityName($table)
			." SET ".$this->getSetters($record)
			." WHERE ".$this->getItemsAsFilters($filters)
			.';';
		return $sql;
	}
}

?>