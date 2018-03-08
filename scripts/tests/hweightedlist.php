<?php


require_once("../src/compare.php");
inc('/src/http/HttpWeightedList.php');

$w =  new HttpWeightedList();
$w->setWeight('es-CO', 1.0);
$w->setWeight('es-ES', 0.9);
$w->setWeight('es', 0.8);
$w->setWeight('fr-FR', 0.7);
$w->setWeight('fr-CA', 0.6);
$w->setWeight('fr', 0.5);
$w->setWeights([
	['es-CH','q'=>0.4],
	['pt-BZ','q'=>0.3],
	['pt','q'=>0.2]
]);
$w->parse("xx-XX;q=0.10, yy-YY;q=0.09, zz-ZZ;q=0.08");
var_dump($w);

echo "$w\n";
?>