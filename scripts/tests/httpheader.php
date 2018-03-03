<?php
$response = [
	"HTTP/1.1 200 OK",
	"Content-Type: text/html",
	"Connection: close",
	"Cache-Control: no-cache",
	"Connection: close",
	"Content-Length: 2888",
	"X-Iinfo: 5-40679887-0 0NNN RT(1520032536710 846) q(1 -1 -1 0) r(1 -1) B10(8,881023,0) U10000",
	"Set-Cookie: incap_ses_209_678271=s4GOK6Lq7njmj5Bh94XmAhnbmVoAAAAAeYQVy7cDuaWWAMhbwrUNqQ==; path=/; Domain=.exito.com"
];

require_once('../src/compare.php');

inc('/src/util/HttpHeader.php');

$h = new HttpHeader();
$h->read();
//$h->captureCookiesFromResponse($response);
var_dump($h->extractCookies("nlbi_678271=+3LDMfXNgho664a/CyiYNQAAAAA+X1EWnpavp8Iv8AccpfWz; incap_ses_517_678271=tXb0DaVsjE2wpeCyiMEsB6BfmFoAAAAAM03bC3dQnAlciO7rvaiIWg==; _ga=GA1.2.1986141544.1519935395; _gid=GA1.2.1489138054.1519935395; bunting_visit_cookie=1551471456637; admananalytics=1519935395247-71; adman_session_id=1519935395249-76; com.silverpop.iMAWebCookie=5255dbb7-2d91-aa60-ad47-449863215369; incap_ses_388_678271=bqx/HBvkigA6SyJfC3RiBdVYmVoAAAAAbanhkS7109bNvNtO5koDXQ==; visid_incap_678271=I8gkkvP+Q86ARXrUbbZDPKBfmFoAAAAAQkIPAAAAAACAoo6CAb5VY9J1ZTpyjVDLJHwJUJQQgEhO; JSESSIONID=A5F3361AD52090866D6AD259D9B69A7A.nodeweb8; incap_ses_209_678271=S9zKONrOtH+zn55h94XmAsbgmVoAAAAAG8JmlQJMqAxrTD7/ygWHBA==; com.silverpop.iMA.session=592c1d21-99a4-62db-2327-649656b5387c; com.silverpop.iMA.page_visit=-891905273:; wisepops=%7B%22version%22%3A3%2C%22uid%22%3A%2225143%22%2C%22ucrn%22%3A61%2C%22last_req_date%22%3A%222018-03-02T23%3A39%3A58.837Z%22%2C%22popins%22%3A%7B%22112984%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-03-01T20%3A16%3A40.084Z%22%7D%2C%22113606%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-03-02T23%3A39%3A55.730Z%22%7D%7D%2C%22cross_subdomain%22%3Atrue%7D; wisepops_session=%7B%22is_new%22%3A0%2C%22req_count%22%3A2%2C%22popins%22%3A%5B113606%5D%7Dm"));
echo $h->toString()."\n";
?>