<?php

return [
	'accept' => [
		'text/html',
		'application/xhtml+xml',
		['application/xml', 'q' => 0.9],
		'image/webp',
		'image/apng',
		['*/*', 'q' => 0.8 ]
	],
	'accept-encoding' => 'identity',
	'accept-language' => [
		'en-US',
		['en', 'q' => 0.9],
		['es-419', 'q' => 0.8],
		['es', 'q' => 0.7]
	],
	'upgrade-insecure-requests' => 1,
	'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36',
];

?>