<?php

interface ISqlLiteral {
	public function getLiteral      (&$value );
	public function getLiteralList  (array &$record);
	public function getLiteralTable (array &$table );
}

?>