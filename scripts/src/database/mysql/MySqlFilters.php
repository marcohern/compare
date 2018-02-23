<?php

inc("/src/database/SqlConstants.php");
inc("/src/database/ISqlFilters.php");
inc('/src/database/mysql/MySqlColumnName.php');

class MySqlFilters extends MySqlColumnName implements ISqlFilters {
	public function getFilters(array &$filters = null) {
		if (empty($filters)) return SQL_STR_EMPTY;
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($filters as $k => $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_AND;
			$sql .= $this->getColumnName($k).' = '.$this->getLiteral($v);
			$i++;
		}
		return $sql;
	}
}

?>