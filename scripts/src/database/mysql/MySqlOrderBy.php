<?php

inc("/src/database/SqlConstants.php");
inc("/src/database/ISqlOrderBy.php");
inc('/src/database/mysql/MySqlAssignments.php');

class MySqlOrderBy extends MySqlAssignments implements ISqlOrderBy {
	public function getOrderBy(array &$orderby = null) {
		if (empty($orderby)) return SQL_STR_EMPTY;
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach ($orderby as $k => $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			if (is_int($k)) $sql .= $this->getColumnName($v).SQL_ORD_ASC; 
			else $sql .= $this->getColumnName($k)." $v";
			$i++;
		}
		return $sql;
	}
}

?>