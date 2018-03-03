<?php

class HttpHeader {
	public $accept = null;
	public $acceptEncoding = 'identity';
	public $acceptLanguage = null;
	public $upgradeInsecureRequests = null;
	public $userAgent = null;
	public $cookies = null;
	public $setCookie = null;

	public function toString() {
		$header = "";
		if(!empty($this->accept)) $header.= "Accept: {$this->accept}\r\n";
		if(!empty($this->acceptEncoding)) $header.= "Accept-Encoding: {$this->acceptEncoding}\r\n";
		if(!empty($this->upgradeInsecureRequests)) $header.= "Upgrade-Insecure-Requests: {$this->upgradeInsecureRequests}\r\n";
		if(!empty($this->acceptLanguage)) $header.= "Accept-Language: {$this->acceptLanguage}\r\n";
		if(!empty($this->userAgent)) $header.= "User-Agent: {$this->userAgent}\r\n";
		if(!empty($this->cookies)) $header.= "Cookie: {$this->cookies}\r\n";
		return $header; 
	}

	public function read() {
		$arr = read('/src/config/http_headers.php');
		foreach ($arr as $k => $v) {
			switch ($k) {
				case 'Accept':
					$this->accept = $v;
					break;
				case 'Accept-Encoding':
					$this->acceptEncoding = $v;
					break;
				case 'Accept-Language':
					$this->acceptLanguage = $v;
					break;
				case 'Upgrade-Insecure-Requests':
					$this->upgradeInsecureRequests = $v;
					break;
				case 'User-Agent':
					$this->userAgent = $v;
					break;
			}
		}
	}

	public function extractCookies($cookies) {
		$c = [];
		if (preg_match_all('/(?<id>\w+)=(?<val>[^;]*)(;\s*|$)/', $cookies, $matches)) {
			$n = count($matches[0]);
			for ($i=0; $i<$n; $i++) {
				$id  = $matches['id'][$i];
				$val = $matches['val'][$i];
				$c[$id] = $val;
			}
		}
		return $c;
	}

	public function addCookies() {

	}

	public function captureSetCookie(array &$response) {
		$cookie = '';
		foreach ($response as $v) {
			if (is_string($v)) {
				if (preg_match("/^Set-Cookie:\s*(?<value>.*)/i", $v, $match)) {
					if (!empty($cookie)) $cookie.=';';
					$arr .= $match['value'];
				}
			}
		}
		$this->setCookie = $cookie;
	}
}

?>