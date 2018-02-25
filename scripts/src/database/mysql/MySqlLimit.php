<?php

inc("/src/database/SqlConstants.php");
inc("/src/database/ISqlLimit.php");
inc('/src/database/mysql/MySqlOrderBy.php');

class MySqlLimit extends MySqlOrderBy implements ISqlLimit {
	public function getLimit($limit, $offset = null) {
		$sql = $limit;
		if (!is_null($offset)) $sql.=", $offset";
		return $sql;
	}
}

?>