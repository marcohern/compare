<?php

interface ISqlColumnName {
	public function getColumnName(&$colname, &$alias = null);
	public function getColumnList(array &$record);
	public function getColumnAliasList(array &$record);
}

?>