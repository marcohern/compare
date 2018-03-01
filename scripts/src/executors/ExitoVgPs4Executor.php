<?php

inc("/src/executors/Executor.php");
inc("/src/crawlers/StandardColumnContainer.php");

class ExitoVgPs4Executor extends Executor {

	private static $ops = [
		'http'=>[
			'method'=>"GET",
			'header'=>"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8\r\n"
			         ."Accept-Encoding: identity\r\n"
			         ."Accept-Language: en-US,en;q=0.9,es-419;q=0.8,es;q=0.7\r\n"
			         ."Upgrade-Insecure-Requests: 1\r\n"
			         ."User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36\r\n"
			         ."Cookie: JSESSIONID=BFC088DA76BC04130DD604A75A572C10.nodeweb8; visid_incap_678271=I8gkkvP+Q86ARXrUbbZDPKBfmFoAAAAAQUIPAAAAAAAzKIjqR8aALHHVhy027ddN; nlbi_678271=+3LDMfXNgho664a/CyiYNQAAAAA+X1EWnpavp8Iv8AccpfWz; incap_ses_517_678271=tXb0DaVsjE2wpeCyiMEsB6BfmFoAAAAAM03bC3dQnAlciO7rvaiIWg==; _ga=GA1.2.1986141544.1519935395; _gid=GA1.2.1489138054.1519935395; bunting_visit_cookie=1551471456637; admananalytics=1519935395247-71; adman_session_id=1519935395249-76; com.silverpop.iMAWebCookie=5255dbb7-2d91-aa60-ad47-449863215369; com.silverpop.iMA.session=9d44b2e9-a813-d1a9-61e3-cb523e5a566e; com.silverpop.iMA.page_visit=-891905273:; wisepops=%7B%22version%22%3A3%2C%22uid%22%3A%2225143%22%2C%22ucrn%22%3A61%2C%22last_req_date%22%3A%222018-03-01T20%3A16%3A34.634Z%22%2C%22popins%22%3A%7B%22112984%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-03-01T20%3A16%3A40.084Z%22%7D%7D%2C%22cross_subdomain%22%3Atrue%7D; wisepops_session=%7B%22is_new%22%3A1%2C%22req_count%22%3A1%2C%22popins%22%3A%5B112984%5D%7D"
		]
	];

	protected function initParams(ExecutorParams &$params) {
		$params->pagerExp =  '/'
			.'<p>Mostrando <strong> (\d+) - (?<rpp>\d+) de (?<total>\d+) <\/strong>resultados<\/p>'
		.'/';
		$params->itemsExp = read('/src/expresions/exito_product_list.php');

		$columns = new StandardColumnContainer();
		$columns->addName('code',[
			'/^\s*Videojuego /i',
			'/\s*(para)?\s*PS4/i',
			'/\s*-\s+www\.exito\.com/i',
			'/\s*Playstation 4/i',
			'/Nintendo Switch/i',
			'/Edición Estándar/i',
			'/Edición Legendaria/i'
		],[
			'/[áä]/ui' => "a",
			'/[éë]/ui' => "e",
			'/[íï]/ui' => "i",
			'/[óö]/ui' => "o",
			'/[úü]/ui' => "u",
		], ' ps4');

		$params->columns = $columns;
	}protected function initCrawler(IDatabase $db, Logger $logger, ExecutorParams $params) {
		$crawler = parent::initCrawler($db, $logger, $params);
		$context = stream_context_create(self::$ops);
		$crawler->setContext($context);
		return $crawler;
	}
}

?>