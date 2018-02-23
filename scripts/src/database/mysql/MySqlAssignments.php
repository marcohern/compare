<?php


inc("/src/database/SqlConstants.php");
inc('/src/database/ISqlAssignments.php');
inc("/src/database/mysql/MySqlFilters.php");

class MySqlAssignments extends MySqlFilters implements ISqlAssignment {
	public function getAssignments(array &$record) {
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($record as $k => $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			$sql .= $this->getColumnName($k).' = '.$this->getLiteral($v);
			$i++;
		}
		return $sql;
	}
}

?>