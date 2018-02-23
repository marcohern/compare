<?php

interface ISqlColumnName {
	public function getColumnName(&$colname, &$alias = null);
	public function getColumnAliasList(&$record);
}

?>