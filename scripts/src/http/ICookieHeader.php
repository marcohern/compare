<?php

interface ICookieHeader {
	public function saveCookie($domain);
	public function loadCookie($domain);
	public function mergeCookies($cookies);
}
?>