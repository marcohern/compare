<?php

return '/'
	.'<div class="row">\s*'
		.'<a href="(?<url1>[^"]+)"\s+.*'
			.'class="[^"]+"\s+'
			.'onclick="[^"]+"\s+'
			.'title="(?<code>[^"]+)">\s*.*'
			.'<div class="image">\s*'
				.'<img src="(?<image1>[^"]+)"\s+'
					.'alt="(?<image1_alt>[^"]*)"\s+.*'
					.'onerror="[^"]+"\s+'
					.'class="img-responsive">\s*'
			.'<\/div>\s*'
			.'(<div class="[^"]+">\s*'
				.'<div class="[^"]+">\s*(\d+)\s*<\/div>\s*'
				.'<small>\s*%\s*<\/small>\s*'
			.'<\/div>\s*)?'
		.'<\/a>\s*'
		.'<div class="[^"]+">\s*'
			.'<a href="([^"]+)"\s+'
			.'onclick="[^"]+"\s+'
			.'title="([^"]+)">\s*'
				.'<div class="col-name">\s*'
					.'<h1 class="name">(.*)<\/h1>\s*'
					.'<h2 class="brand">(?<brand1>.*)<\/h2>\s*'
				.'<\/div>\s*'
					
				.'<div class="col-price">\s*'
					.'<p class="[^"]+">\s*'
						.'<span class="money">\s*'
							.'(?<price1>[\d,.]+)\s*'
						.'<\/span>\s*'
					.'<\/p>\s*'

					.'(<p class="[^"]+">\s*'
						.'Antes: <s class="money">\s*'
							.'(?<price2>[\d,.]+)\s*'
						.'<\/s>\s*'
					.'<\/p>\s*)?'
.'/';
?>