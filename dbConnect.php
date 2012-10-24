<?php
$host = "localhost";
$db_name = "spider";
$username = "spidersql";
$password = "";

$con = mysql_connect("$host","$username","$password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }