<?php

interface ISqlLimit {
	public function getLimit($limit, $offset = null);
}

?>