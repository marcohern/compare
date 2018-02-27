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
			$op = ' = ';
			$key = $k;
			$value = $v;
			if (is_string($k) && is_array($v)) {
				$op = ' '.$v[0].' ';
				$value = $v[1];
			} else if (is_int($k) && is_array($v)) {
				$key   = $v[0];
				$op    = ' '.$v[1].' ';
				$value = $v[2];
			}
			$sql .= $this->getColumnName($key).$op.$this->getLiteral($value);
			$i++;
		}
		return $sql;
	}
}

?>