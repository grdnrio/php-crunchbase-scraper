<?php

// Specify tidy configuration
$config = array(
           'indent'         => false,
           'output-xhtml'   => true,
           'wrap'           => false);

$category="cloud-computing";

$pageContent = file_get_contents('http://www.crunchbase.com/tag/' . $category);

//echo $pageContent;

$content = new tidy;
$content->parseString($pageContent, $config, 'utf8');
$content->cleanRepair();

preg_match('/<div class="outterbox float_photo">\s*<table>(.*)<\/table>/sU', $pageContent, $companies);
$companiesOut = $companies[1];

var_dump($companiesOut);

?>