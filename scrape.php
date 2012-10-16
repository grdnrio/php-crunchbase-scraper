<?php

$pageContent = file_get_contents('http://www.crunchbase.com/company/aamcomp');

//extract company name
preg_match('/<td class="td_left">Twitter<\/td><td class="td_right"><a href="http:\/\/twitter.com\/[^"]+" rel="nofollow">([^<]*)<\/a><\/td>/s', $pageContent, $compName);
$compNameOut = $compName[1];

var_dump($compNameOut);

//extract twitter handle
preg_match('/<h1 class="h1_first">([^<]+)/is', $pageContent, $twitter);
$twitterOut = trim($twitter[1]);

var_dump($twitterOut);

?>