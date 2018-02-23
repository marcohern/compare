<?php


inc("/src/database/SqlConstants.php");
inc("/src/database/ISqlLiteral.php");

class SqlLiteral implements ISqlLiteral {
	public function getLiteral      (&$value ) {
		if (is_null($value)) {
			return "NULL";
		}
		if (is_a($value, '\DateTime')) {
			return SQL_STR_CONT.$value->format("Y-m-d H:i:s").SQL_STR_CONT;
		}
		if (is_string($value)) {
			return SQL_STR_CONT.addslashes($value).SQL_STR_CONT;
		}
		if (is_integer($value) || is_float($value)) {
			return $value;
		}
		return SQL_STR_CONT.addslashes($value).SQL_STR_CONT; 
	}

	public function getLiteralList  (&$record) {
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($record as $v) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			$sql .= $this->getLiteral($v);
			$i++;
		}
		return $sql;
	}

	public function getLiteralTable (&$table ) {
		$i = 0;
		$sql = SQL_STR_EMPTY;
		foreach($table as $record) {
			$sql .= ($i===0) ? SQL_STR_EMPTY : SQL_EXP_SEP;
			$sql .= SQL_EXP_CONT_OPEN.$this->getLiteralList($record).SQL_EXP_CONT_CLOSE;
			$i++;
		}
		return $sql;
	}
}

?>