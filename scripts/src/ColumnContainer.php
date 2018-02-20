<?php

require_once('Column.php');

class ColumnContainer {
	private $columns;

	public function __construct() {

	}

	public function add(Column $column) {
		$this->columns[$column->getName()] = $column;
	}

	public function getCount() {
		return count($this->columns);
	}

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

	public function processValues(&$record) {
		foreach ($this->columns as $k => $c) {
			$c->processValue($record, $record[$k]);
		}
	}
}
?>