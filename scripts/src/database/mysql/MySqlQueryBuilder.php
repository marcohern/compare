<?php

inc("/src/database/SqlConstants.php");
inc('/src/database/mysql/MySqlOrderBy.php');
inc("/src/database/ISqlQueryBuilder.php");

class MySqlQueryBuilder extends MySqlOrderBy implements ISqlQueryBuilder {
	public function select($table, &$columns = null, array &$filters = null, array &$orderby = null) {
		$sqlColumns = (empty($columns)) ? '*' : $this->getColumnAliasList($columns);
		$sqlOrderBy = $this->getOrderBy($orderby); 
		$sql = "SELECT $sqlColumns FROM $table";
		$sql .= (empty($filters)) ? '' : " WHERE ".$this->getFilters($filters);
		if (!empty($sqlOrderBy)) $sql.=" ORDER BY $sqlOrderBy";
		return $sql;
	}
	public function insert($table, array &$data = null) {}
	public function update($table, array &$record, array &$filters = null) {}
	public function delete($table, array &$filters = null) {}
}

?>