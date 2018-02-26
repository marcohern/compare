<?php

inc('/src/jsonexplorers/JsonExplorer.php');

interface IJsonCrawler {
	public function setJsonExplorer(JsonExplorer $jex);
}
?>