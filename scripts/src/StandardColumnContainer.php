<?php

require_once("ColumnContainer.php");

class StandardColumnContainer extends ColumnContainer {
	public function __construct() {
		parent::__construct();
	}

	public function addSimple($name) {
		$c = new Column($name);
		$this->add($c);
		return $c;
	}

	public function addEscape($name) {
		$c = new Column($name);
		$c->setEscape(true);
		$this->add($c);
		return $c;
	}

	public function addName($name, array $remove = [], array $replace = [], $append = '') {
		$c = new Column($name);
		$c->setNormalize(true);
		$c->setToMd5('signature');
		$c->setCopyPreRemove('name');
		$c->setCopyPreNormalize('title');
		$c->setEscape(false);
		$c->setRemove($remove);
		$c->setReplace($replace);
		$c->setAppend($append);
		$this->add($c);
		return $c;
	}
}
?>