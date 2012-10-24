<?php

include(__DIR__."dbConnect.php");
include(__DIR__."createTable.php");

// Specify tidy configuration
$config = array(
           'indent'         => false,
           'output-xhtml'   => true,
           'wrap'           => false);

//set category for retrieving company list
$category="cloud-computing";

//build page to scrape; concatenate url & variable
$pageContent = file_get_contents('http://www.crunchbase.com/tag/' . $category);

$content = new tidy;
$content->parseString($pageContent, $config, 'utf8');
$content->cleanRepair();

//select number of results from a tag
preg_match('/<h2>Companies ([^<]+)/s', $pageContent, $resultsNum);
$results = $resultsNum[1];

//select company names from first (company) table on category page
preg_match('/<div class="outterbox float_photo">\s*<table>(.*)<\/table>/sU', $pageContent, $companies);
$companiesOut = $companies[1];

//clean the list and match company url ready for loop
preg_match_all('/href="\/company\/(.*?)"/s', $companiesOut, $companiesClean);
$clean = $companiesClean[1];

//select spider database at local host
mysql_select_db("spider") or die(mysql_error());

createTable($category);

//page title
echo("<h1>Display results for the category \"$category\"</h1>");
echo("<h2>$results results were found</h2>");
echo "\n\n\n";


//loop through each item building company variable details (full URL, company name and Twitter handle)
foreach($clean as $value) {
	$fullUrl = "http://www.crunchbase.com/company/$value";
	$pageContent = file_get_contents("http://www.crunchbase.com/company/$value");

	//extract company name
	preg_match('/<h1 class="h1_first">([^<]+)/is', $pageContent, $compName);
	$compNameOut = trim($compName[1]);

	//extract twitter handle
	preg_match('/<td class="td_left">Twitter<\/td><td class="td_right"><a href="http:\/\/twitter.com\/[^"]+" rel="nofollow">([^<]*)<\/a><\/td>/s', $pageContent, $twitter);
	
	//check for empty Twitter accounts and assign TwitterOut variable with empty if match
	if (empty($twitter[1])) {
		$twitterOut = "No Twitter Account";
	} else {
		$twitterOut = trim($twitter[1]);
	}
	
	//display company details
	echo(
	   "<ul>
	   		<li><strong>$compNameOut</strong></li>
			<li>$twitterOut</li>
			<li><a href=\"http://www.crunchbase.com/company/$value\" target=\"_blank\">$fullUrl</a></li>
		</ul>
		<br />"		);
	
	//limit selection
	$i++;
	if ($i > 5) {
		exit;
	}
}


?>