<?php

inc("/src/database/SqlConstants.php");
inc('/src/database/mysql/MySqlLimit.php');
inc("/src/database/ISqlQueryBuilder.php");

class MySqlQueryBuilder extends MySqlLimit implements ISqlQueryBuilder {
	public function select($table, &$columns = null, array &$filters = null, array &$orderby = null, $limit = null) {
		$sqlColumns = (empty($columns)) ? '*' : $this->getColumnAliasList($columns);
		$sqlOrderBy = $this->getOrderBy($orderby); 
		$sql = "SELECT $sqlColumns FROM ".$this->getColumnName($table);
		$sql .= (empty($filters)) ? '' : " WHERE ".$this->getFilters($filters);
		if (!empty($sqlOrderBy)) $sql.=" ORDER BY $sqlOrderBy";
		if (!is_null($limit)) $sql.= " LIMIT ".$this->getLimit($limit);
		$sql.=";";
		return $sql;
	}

	public function insert($table, array &$data = null) {
		$sql = "INSERT INTO ".$this->getColumnName($table);
		if (count($data) > 0) {
			if (array_key_exists(0, $data)) {
				$sql .= " (".$this->getColumnList($data[0]).") VALUES ".$this->getLiteralTable($data).";";
			} else {
				$sql .= "(".$this->getColumnList($data).") VALUES (".$this->getLiteralList($data).");"; 
			}
		}
		return $sql;
	}

	public function update($table, array &$record, array &$filters = null) {
		$sql = "UPDATE ".$this->getColumnName($table)
			." SET ".$this->getAssignments($record);
		$sql .= (empty($filters)) ? '' : " WHERE ".$this->getFilters($filters).";";
		return $sql;
	}

	public function delete($table, array &$filters = null) {
		$sql  ="DELETE FROM ".$this->getColumnName($table); 
		$sql .= (empty($filters)) ? '' : " WHERE ".$this->getFilters($filters).";";
		return $sql;
	}
}

?>