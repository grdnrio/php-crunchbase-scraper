<?php

include 'categoryScrape.php';
include 'dbConnect.php';

//select table from category being crawled
mysql_select_db($db_name, $con);

function createTable($category) {

	$sql = "CREATE TABLE IF NOT EXISTS `$category` (
	  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `CompanyName` varchar(255) NOT NULL,
	  `Twitter` varchar(255) NOT NULL,
	  `CBURL` varchar(255) NOT NULL,
	  PRIMARY KEY (`ID`),
	  UNIQUE KEY `Twitter` (`Twitter`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

}