<?php

return '/'
		.'<a href="(?<url>[^\"]*)" class="img containerImg" title="(?<code>[^\"]*)">\s*'
			.'<img\s*src="" alt="([^\"]*)" class="lazy hoverImg" data-original="([^\"]*)"\/>\s*'
		.'<\/a>\s*'
		.'<input name="productId" class="productId" value="(?<productId>[^\"]*)" type="hidden"\/>\s*'
		.'<input name="productSkuId" class="productSkuId" value="(?<productSkuId>[^\"]*)" type="hidden"\/>\s*'
	.'<\/div>\s*'
	.'<section class="color-carousel hidden-xs hidden-sm">\s*'
		.'<div class="empty-div-height">&nbsp;<\/div>\s*'
	.'<\/section>\s*'
	.'<div class="info-box informationContainer">\s*'
		.'<p class="brand jq-brand">\s*'
			.'<a href="([^\"]*)">\s*(?<brand>[^<]*)<\/a>\s*'
		.'<\/p>\s*'
		.'<p class="name jq-name">\s*'
			.'<a href="([^\"]*)">\s*([^<]*)<\/a>\s*'
		.'<\/p>\s*'
		.'<p class="sku">SKU: (\d+)<\/p>\s*'
		.'<p class="price jq-price PLP-NORMAL-1">\s*'
		.'<span class="Precio">\s*'
			.'Precio normal:&nbsp;'
		.'<\/span>\s*'
		.'<b>\$(?<price>[^&]*)&nbsp;UND<\/b>'
.'/';

?>