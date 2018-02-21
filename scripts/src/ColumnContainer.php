<?php

require_once('Column.php');

/**
 * Contains multiple columns of a single table.
 * it proceses and converts the matches of a regular
 * expresion search into a single table.  
 */
class ColumnContainer {

	private $columns;//array of columns


	/**
	 * Insert a column
	 */
	public function add(Column $column) {
		$this->columns[$column->getName()] = $column;
	}

	/**
	 * Return amount of columns
	 */
	public function getCount() {
		return count($this->columns);
	}

	/**
	 * Converts a set of regex matches into a table
	 */
	public function processMatches(&$matches) {
		$n = count($matches[0]);
		$table = [];
		for($i=0; $i<$n; $i++) {
			$record = [];

			foreach ($this->columns as $k => $column) {
				$column->processValue($record, $matches[$k][$i]);
			}

			$table[] = $record;
		}
		return $table;
	}

	/**
	 * Process all values of a record
	 */
	public function processValues(&$record) {
		foreach ($this->columns as $k => $c) {
			$c->processValue($record, $record[$k]);
		}
	}
}
?>