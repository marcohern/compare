<?php
require_once("../src/compare.php");

inc("/src/http/HttpHeader.php");

$url = 'https://www.exito.com/Tecnologia-Consolas_y_video_juegos-PlayStation_4-Juegos_PS4/_/N-2b5q';
$charset = 'UTF-8';
$source = "Host: www.exito.com
Cache-Control: no-cache
Cookie: _ga=GA1.2.539759231.1518925568; bunting_visit_cookie=1550461651440; admananalytics=1518925576151-77; com.silverpop.iMAWebCookie=c4994d5b-4523-e7c8-3864-abc8169a8254; cto_lwid=70b1437e-046c-4dce-96a8-406673152b77; nlbi_678271=oS06GV4JNl0p6nZ3CyiYNQAAAACB52I8rk+jXhgbb7uqmZGb; _gid=GA1.2.1325076539.1519783470; adman_session_id=1519783470699-7; incap_ses_619_678271=sQHScN0UThnIFYJ4vyGXCHoblloAAAAAgMT/tcgWt2hOElKLKGabng==; incap_ses_223_678271=JfQ6Vp0TlkXMfBGC+0EYA3LAlloAAAAAkIcbr2aZR9xP07NYhhWQXg==; visid_incap_678271=42NTX8xHQlCf+fbEhg21L//2iFoAAAAARkIPAAAAAACANYOCAch6zqK6GrbP2AduCq6fu3mzgC6D; incap_ses_388_678271=Y5l8ObkSjzx19zRcC3RiBXZil1oAAAAAISPRKu5XCg+IivG8obv6VQ==; JSESSIONID=40C16B8E8E6640C8957A78A251F3BC80.nodeweb8; incap_ses_517_678271=NlBcDgJusiU2ZpOyiMEsB84xmFoAAAAAD3/Gj1MfbgaLV8Dhy9eXAA==; _dc_gtm_UA-56744306-1=1; wisepops=%7B%22version%22%3A3%2C%22uid%22%3A%2225143%22%2C%22ucrn%22%3A9%2C%22last_req_date%22%3A%222018-03-01T17%3A01%3A01.868Z%22%2C%22popins%22%3A%7B%2288598%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-02-18T03%3A46%3A19.298Z%22%7D%2C%22108582%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-02-18T14%3A20%3A22.312Z%22%7D%2C%22112626%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-03-01T02%3A16%3A27.727Z%22%7D%2C%22112984%22%3A%7B%22display_count%22%3A1%2C%22display_date%22%3A%222018-02-28T02%3A04%3A37.084Z%22%7D%7D%2C%22cross_subdomain%22%3Atrue%7D; wisepops_session=%7B%22is_new%22%3A0%2C%22req_count%22%3A1%2C%22popins%22%3A%5B%5D%7D; _gat_UA-56744306-1=1; com.silverpop.iMA.session=5beb3ae8-5409-66b4-0aa8-b99d19879954; com.silverpop.iMA.page_visit=-891905273:
Postman-Token: 91f17a40-62a1-d88c-6e05-464bfada046b";

$content = mb_convert_encoding(file_get_contents($url),$charset);
$h = new HttpHeader($http_response_header);
var_dump($h);

$x = $h->setCookie;
var_dump($x);
?>