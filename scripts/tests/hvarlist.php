<?php

require_once("../src/compare.php");
inc('/src/http/HttpVarList.php');

$h = new HttpVarList();

$h->setValue('foo','bar');
$h->set(new HttpVar('man','chu'));
$h->parse("a=b;c=d;e=f");
$h->parse("foo=fax;manchu");
echo "$h\n";
?>