<?php

interface ISqlLiteral {
	public function getLiteral      (&$value );
	public function getLiteralList  (&$record);
	public function getLiteralTable (&$table );
}

?>