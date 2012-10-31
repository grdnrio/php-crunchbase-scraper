<?php

$host = "jg1.lab.mch.catn.com";
$db_name = "spider";
$username = "spidersql";
$password = "TN5TnjZCrK42q7Dd";

$con = mysql_connect("$host","$username","$password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  } else {
	  var_dump($con);
  }