<?php

inc("/src/database/SqlConstants.php");
inc("/src/database/SqlLiteral.php");
inc('/src/database/ISqlColumnName.php');

class MySqlColumnName extends SqlLiteral implements ISqlColumnName {
	public function getColumnName(&$colname, &$alias = null) {
		if (is_null($alias)) {
			return SQL_MY_ID_CONT.$colname.SQL_MY_ID_CONT;
		}
		else {
			return $colname.SQL_AS.SQL_MY_ID_CONT.$alias.SQL_MY_ID_CONT;
		}
	}

	public function getColumnList(array &$record) {
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($record as $k => $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			$sql .= $this->getColumnName($k);
			$i++;
		}
		return $sql;
	}

	public function getColumnAliasList(array &$record) {
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($record as $k => $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			if (is_int($k)) $sql .= $this->getColumnName($v);
			else            $sql .= $this->getColumnName($v, $k);
			$i++;
		}
		return $sql;
	}
}

?>