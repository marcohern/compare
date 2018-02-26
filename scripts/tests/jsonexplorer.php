<?php

require_once("../src/compare.php");

inc('/src/jsonexplorers/FalabellaProductsJsonExplorer.php');

$json = json_decode("{\"componentDomId\":\"fbra_browseProductList\",\"controlParameter\":{\"enableBankPromotions\":false,\"enableProductCompare\":true},\"componentType\":\"Browse-PLP\",\"state\":{\"searchItemList\":{\"resultsPerPage\":16,\"resultsTotal\":96,\"pagesTotal\":6,\"curentPage\":1,\"useRecordImage\":false,\"resultList\":[{\"productId\":\"3254925\",\"url\":\"/falabella-co/product/3254925/Consola-PS4-Hits-Bundle-2\",\"brand\":\"Sony\",\"backendCategory\":\"J11130101\",\"skuId\":\"3254925\",\"mediaAssetId\":\"3254925\",\"onImageHover\":\"second\",\"title\":\"Consola PS4 Hits Bundle 2\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"1.599.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3360773\",\"url\":\"/falabella-co/product/3360773/Videojuego-Dragon-Ball-Fighterz\",\"brand\":\"Sony\",\"backendCategory\":\"J11130209\",\"skuId\":\"3360773\",\"mediaAssetId\":\"3360773\",\"onImageHover\":\"second\",\"title\":\"Videojuego Dragon Ball Fighterz\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"229.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2853564\",\"url\":\"/falabella-co/product/2853564/Videojuego-Call-of-Duty-Infinite-Warfare\",\"brand\":\"PlayStation 4\",\"backendCategory\":\"J11130209\",\"skuId\":\"2853564\",\"mediaAssetId\":\"2853564\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego Call of Duty Infinite Warfare\",\"meatSticker\":{\"second\":{\"title\":\"<span>68%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"69.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"219.900\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2729564\",\"url\":\"/falabella-co/product/2729564/Videojuego-Homefront-The-Revolution\",\"brand\":\"Sony\",\"backendCategory\":\"J11130209\",\"skuId\":\"2729564\",\"mediaAssetId\":\"2729564\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego Homefront The Revolution\",\"meatSticker\":{\"second\":{\"title\":\"<span>50%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"49.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"99.990\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":true,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2510865\",\"url\":\"/falabella-co/product/2510865/Videojuego-God-of-War-3-Remasterizado\",\"brand\":\"PlayStation 4\",\"backendCategory\":\"J11130209\",\"skuId\":\"2510865\",\"mediaAssetId\":\"2510865\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego God of War 3 Remasterizado\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"99.990\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":5.0,\"totalReviews\":1,\"isCompare\":false,\"isCODAvailable\":true,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2774938\",\"url\":\"/falabella-co/product/2774938/Videojuego-Call-of-Duty-Blackops-III\",\"brand\":\"Sony\",\"backendCategory\":\"J11130209\",\"skuId\":\"2774938\",\"mediaAssetId\":\"2774938\",\"onImageHover\":\"second\",\"title\":\"Videojuego Call of Duty Blackops III\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"229.990\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3219338\",\"url\":\"/falabella-co/product/3219338/Consola-1TB-FIFA18\",\"brand\":\"Sony\",\"backendCategory\":\"J11130101\",\"skuId\":\"3219338\",\"mediaAssetId\":\"3219338\",\"onImageHover\":\"second\",\"title\":\"Consola 1TB FIFA18\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"1.599.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":3.0,\"totalReviews\":2,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3073246\",\"url\":\"/falabella-co/product/3073246/Videojuego-Crash-Bandicoot-Nsane-Trilogy\",\"brand\":\"Sony\",\"backendCategory\":\"J11130209\",\"skuId\":\"3073246\",\"mediaAssetId\":\"3073246\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego Crash Bandicoot Nsane Trilogy\",\"meatSticker\":{\"second\":{\"title\":\"<span>20%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"119.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"149.900\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2583898\",\"url\":\"/falabella-co/product/2583898/Videojuego-Saint-Seiya-Soldiers-S\",\"brand\":\"PlayStation 4\",\"backendCategory\":\"J11130209\",\"skuId\":\"2583898\",\"mediaAssetId\":\"2583898\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego Saint Seiya Soldiers S\",\"meatSticker\":{\"second\":{\"title\":\"<span>54%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"91.990\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"199.900\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":true,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3174454\",\"url\":\"/falabella-co/product/3174454/Videojuego-Watch-Dogs\",\"brand\":\"PlayStation 4\",\"backendCategory\":\"J11130209\",\"skuId\":\"3174454\",\"mediaAssetId\":\"3174454\",\"onImageHover\":\"second\",\"title\":\"Videojuego Watch Dogs\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"79.990\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3021263\",\"url\":\"/falabella-co/product/3021263/Videojuego-WRC-6\",\"brand\":\"Sony\",\"backendCategory\":\"J11130209\",\"skuId\":\"3021263\",\"mediaAssetId\":\"3021263\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego WRC 6\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"99.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":true,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3373223\",\"url\":\"/falabella-co/product/3373223/Videojuego-EA-Sports-UFC-3\",\"backendCategory\":\"J11130209\",\"skuId\":\"3373223\",\"mediaAssetId\":\"3373223\",\"onImageHover\":\"second\",\"title\":\"Videojuego EA Sports UFC 3\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"239.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3224729\",\"url\":\"/falabella-co/product/3224729/Gafas-de-Realidad-Aumentada-VR\",\"backendCategory\":\"J11130101\",\"skuId\":\"3224729\",\"mediaAssetId\":\"3224729\",\"onImageHover\":\"zoom\",\"title\":\"Gafas de Realidad Aumentada VR\",\"meatSticker\":{\"second\":{\"title\":\"<span>18%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"1.649.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"1.999.900\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3073239\",\"url\":\"/falabella-co/product/3073239/Consola-500GB-Slim-+-Horizon-Zero-Dawn-+-Ratchet-Clank-+-The-Last-of-Us-Remastered\",\"brand\":\"Sony\",\"backendCategory\":\"J11130101\",\"skuId\":\"3073239\",\"mediaAssetId\":\"3073239\",\"onImageHover\":\"zoom\",\"title\":\"Consola 500GB Slim + Horizon Zero Dawn + Ratchet & Clank + The Last of Us Remastered\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"1.599.990\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":true,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"2328890\",\"url\":\"/falabella-co/product/2328890/Videojuego-Grand-Theft-Auto-V\",\"brand\":\"PlayStation 4\",\"backendCategory\":\"J11130209\",\"skuId\":\"2328890\",\"mediaAssetId\":\"2328890\",\"onImageHover\":\"zoom\",\"title\":\"Videojuego Grand Theft Auto V\",\"meatSticker\":{\"second\":{\"title\":\"<span>25%</span>\",\"className\":\"percentoff\"}},\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"149.890\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false},{\"label\":\"(Normal)\",\"originalPrice\":\"199.990\",\"symbol\":\"$ \",\"type\":2,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":4.0,\"totalReviews\":2,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true},{\"productId\":\"3219342\",\"url\":\"/falabella-co/product/3219342/Videojuego-Naruto-Ninja-Storm-LG\",\"brand\":\"Bandai\",\"backendCategory\":\"J11130209\",\"skuId\":\"3219342\",\"mediaAssetId\":\"3219342\",\"onImageHover\":\"second\",\"title\":\"Videojuego Naruto Ninja Storm LG\",\"useImageAtProductLevel\":false,\"prices\":[{\"label\":\"(Internet)\",\"originalPrice\":\"349.900\",\"symbol\":\"$ \",\"type\":3,\"isLoyalty\":false,\"opportunidadUnica\":false}],\"rating\":0.0,\"totalReviews\":0,\"isCompare\":false,\"isCODAvailable\":false,\"isHDAvailable\":true,\"isCCAvailable\":true,\"availableSkusTotal\":1,\"displayRatings\":true,\"hasSize\":false,\"published\":true}],\"filters\":[{\"name\":\"Categor\u00EDa\",\"type\":\"refresh\",\"state\":\"open\",\"select\":\"single\",\"values\":[{\"label\":\"Accesorios PS4\",\"primaryNav\":\"/category/cat3420969/Accesorios-PS4\",\"selected\":false,\"url\":\"/category/cat3420969/Accesorios-PS4\",\"count\":1},{\"label\":\"Consolas PS4\",\"primaryNav\":\"/category/cat3420966/Consolas-PS4\",\"selected\":false,\"url\":\"/category/cat3420966/Consolas-PS4\",\"count\":2},{\"label\":\"Videojuegos PS4\",\"primaryNav\":\"/category/cat3420967/Videojuegos-PS4\",\"selected\":false,\"url\":\"/category/cat3420967/Videojuegos-PS4\",\"count\":77}],\"searchIn\":false,\"displayingNumber\":50},{\"name\":\"Marca\",\"type\":\"ajax\",\"state\":\"open\",\"select\":\"multi\",\"values\":[{\"label\":\"Activision\",\"primaryNav\":\"/category/cat3020960/PS4/N-36zb\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-36zb\",\"count\":2},{\"label\":\"Bandai\",\"primaryNav\":\"/category/cat3020960/PS4/N-3737\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-3737\",\"count\":4},{\"label\":\"Electronic Arts\",\"primaryNav\":\"/category/cat3020960/PS4/N-3dls\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-3dls\",\"count\":4},{\"label\":\"PlayStation 4\",\"primaryNav\":\"/category/cat3020960/PS4/N-38d4\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-38d4\",\"count\":40},{\"label\":\"Siea\",\"primaryNav\":\"/category/cat3020960/PS4/N-38l0\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-38l0\",\"count\":2},{\"label\":\"Sony\",\"primaryNav\":\"/category/cat3020960/PS4/N-38mg\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-38mg\",\"count\":38},{\"label\":\"Wildcard\",\"primaryNav\":\"/category/cat3020960/PS4/N-38wj\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-38wj\",\"count\":1},{\"label\":\"Xbox One\",\"primaryNav\":\"/category/cat3020960/PS4/N-38xe\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-38xe\",\"count\":1}],\"searchIn\":true,\"displayingNumber\":50},{\"name\":\"Precio\",\"type\":\"ajax\",\"state\":\"open\",\"select\":\"multi\",\"values\":[{\"label\":\"$20.000 - $50.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27db\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27db\",\"count\":1},{\"label\":\"$50.000 - $100.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27dp\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27dp\",\"count\":26},{\"label\":\"$100.000 - $200.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27dc\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27dc\",\"count\":39},{\"label\":\"$200.000 - $300.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27dd\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27dd\",\"count\":24},{\"label\":\"$300.000 - $500.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27de\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27de\",\"count\":2},{\"label\":\"$1.000.000 - $2.000.000\",\"primaryNav\":\"/category/cat3020960/PS4/N-27dg\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-27dg\",\"count\":4}],\"searchIn\":false,\"displayingNumber\":50},{\"name\":\"Tipo\",\"type\":\"ajax\",\"state\":\"open\",\"select\":\"multi\",\"values\":[{\"label\":\"Gafas\",\"primaryNav\":\"/category/cat3020960/PS4/N-1z10u8r\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-1z10u8r\",\"count\":1},{\"label\":\"PS4\",\"primaryNav\":\"/category/cat3020960/PS4/N-1z10syr\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-1z10syr\",\"count\":3},{\"label\":\"Videojuegos\",\"primaryNav\":\"/category/cat3020960/PS4/N-1z10vvr\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-1z10vvr\",\"count\":88},{\"label\":\"Vieojuegos\",\"primaryNav\":\"/category/cat3020960/PS4/N-1z100ae\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-1z100ae\",\"count\":3}],\"searchIn\":false,\"displayingNumber\":20},{\"name\":\"Destacados\",\"type\":\"ajax\",\"state\":\"open\",\"select\":\"multi\",\"values\":[{\"label\":\"Retiro en tienda\",\"primaryNav\":\"/category/cat3020960/PS4/N-1z141xy\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-1z141xy\",\"count\":95}],\"searchIn\":false,\"displayingNumber\":4},{\"name\":\"M\u00E1s comentados\",\"type\":\"ajax\",\"state\":\"open\",\"select\":\"multi\",\"values\":[{\"label\":\"5.0\",\"primaryNav\":\"/category/cat3020960/PS4/N-256m\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-256m\",\"count\":5},{\"label\":\"4.0\",\"primaryNav\":\"/category/cat3020960/PS4/N-256n\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-256n\",\"count\":2},{\"label\":\"3.0\",\"primaryNav\":\"/category/cat3020960/PS4/N-256o\",\"selected\":false,\"url\":\"/category/cat3020960/PS4/N-256o\",\"count\":2}],\"searchIn\":false,\"displayingNumber\":4}],\"sortBys\":[{\"selected\":false,\"label\":\"Precio de menor a mayor\",\"value\":\"/category/cat3020960/PS4?sortBy=1\"},{\"selected\":false,\"label\":\"Precio de mayor a menor\",\"value\":\"/category/cat3020960/PS4?sortBy=2\"},{\"selected\":true,\"label\":\"Recomendados\",\"value\":\"/category/cat3020960/PS4?sortBy=5\"},{\"selected\":false,\"label\":\"Los mejores evaluados\",\"value\":\"/category/cat3020960/PS4?sortBy=6\"},{\"selected\":false,\"label\":\"Nuevos productos\",\"value\":\"/category/cat3020960/PS4?sortBy=7\"},{\"selected\":false,\"label\":\"Marca\",\"value\":\"/category/cat3020960/PS4?sortBy=3\"},{\"selected\":false,\"label\":\"Productos destacados\",\"value\":\"/category/cat3020960/PS4?sortBy=4\"}],\"gridViews\":[{\"value\":\"/category/cat3020960/PS4?gridView=1\",\"gridViewCode\":\"1\",\"selected\":true,\"label\":\"4 columns with square product teasers\",\"extraInfo\":\"M0,0h5v9H0V0z M6,0h5v9H6V0z M12,0h5v9h-5V0z M18,0h5v9h-5V0z M0,10h5v9H0V10z M6,10h5v9H6V10z M12,10h5v9h-5V10z M18,10h5v9h-5V10z\"},{\"value\":\"/category/cat3020960/PS4?gridView=3\",\"gridViewCode\":\"3\",\"selected\":false,\"label\":\"2 columns with square product teasers\",\"extraInfo\":\"M0,37v-37h6v37zM8,37v-37h6v37zM16,37v-37h6v37z\"}],\"selectedRefinements\":{\"clearAllUrl\":\"/category/cat3020960/PS4\"}},\"primaryLabel\":\"PS4\",\"secondaryLabel\":{\"name\":\"Videojuegos\",\"href\":\"/category/cat50590/Videojuegos\",\"title\":\"Videojuegos\",\"label\":\"Videojuegos\"}},\"textDictionary\":{\"collectPointsText\":\"Acumula puntos\",\"clearCompareButton\":\"Borrar todo\",\"titleSelectedFilters\":\"Filtro seleccionado\",\"ofText\":\"de\",\"gridViewText\":\"Mostrando:\",\"doneButtonText\":\"Listo\",\"showMoreText\":\"Ver Filtros\",\"isCODAvailableText\":\"disponible pago contra entrega\",\"sortby\":\"Ordenar por:\",\"compareButton\":\"Comparar\",\"sortByText\":\"Ordenar por:\",\"showingText\":\"Mostrando\",\"compareSubtitle\":\"Est\u00E1s comparando\",\"leftNavigationTitleText\":\"Filtrar por:\",\"outOfStock\":\"No disponible\",\"viewText\":\"Mostrando:\",\"editLocation\":\"Editar Ubicaci\u00F3n\",\"resultsText\":\"resultados\",\"compareBoxText\":\"Comparar\",\"clearSelectedFilters\":\"Borrar filtro\",\"addToBasket\":\"Agregar a tu Bolsa\",\"availableForText\":\"disponibles para\",\"totalResultText\":\"de {0} resultados\",\"agotadoText\":\"Agotado\",\"currentPageResultText\":\"mostrando\",\"productOutOfStockText\":\"No disponible\"},\"endPoints\":{\"getSearchItemList\":{\"name\":\"getSearchItemList\",\"type\":\"GET\",\"path\":\"/rest/model/falabella/rest/browse/BrowseActor/get-product-record-list\"},\"getAssetMediaSet\":{\"name\":\"getAssetMediaSet\",\"type\":\"POST\",\"path\":\"//falabella.scene7.com/is/image/\"},\"addCompareProduct\":{\"name\":\"addCompareProduct\",\"type\":\"POST\",\"path\":\"/rest/model/falabella/rest/browse/BrowseActor/add-compare-product\"},\"removeCompareProduct\":{\"name\":\"removeCompareProduct\",\"type\":\"POST\",\"path\":\"/rest/model/falabella/rest/browse/BrowseActor/remove-compare-product\"},\"addToCart\":{\"name\":\"addToCart\",\"type\":\"POST\",\"path\":\"/falabella-co/bean/falabella/commerce/order/service/ExternalSiteAddToCartService/addItemToOrder\"}}}");

$jex = new FalabellaProductsJsonExplorer($json);

$jex->setRoot("state.searchItemList");
$items = $jex->explore();
echo $jex->getRpp()."\n";
echo $jex->getTotal()."\n";
var_dump($items);
?>