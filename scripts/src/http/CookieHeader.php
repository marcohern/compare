<?php

inc('/src/http/HttpHeader.php');
inc('/src/http/ICookieHeader.php');

class  CookieHeader extends HttpHeader implements ICookieHeader {

	public function saveCookie($domain) {
		$path = ROOT.'/tmp/cookies/$domain.cookie';
		$cookie = $this->get('cookie');
		if (is_null($cookie)) return false; 
		$cookie = serialize($cookie);
		file_put_contents($path, $cookie);
		return true;
	}
	public function loadCookie($domain) {
		$path = ROOT.'/tmp/cookies/$domain.cookie';
		if (!file_exists($path)) return false;
		$content = file_get_contents($path);
		$cookie = deserialize($content);
		$this->set('cookie',$cookie);
		return true;
	}
	public function mergeCookies(array &$cookies) {
		$currentCookie = $this->get('cookie');
		if (empty($currentCookie)) $currentCookie = [];
		$newCookie = array_merge($currentCookie, $cookies);
		$this->set('cookie', $newCookie);
	}
}

?>