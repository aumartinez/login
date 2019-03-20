<?php
 
$mysql_host = "localhost"; //bd host
$mysql_database = "BDName"; //bd name
$mysql_user = "BDUser"; //bd username
$mysql_password = "BDPass"; //bd username pass
 
//Open DB
$conx = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
 
//If connection fails display error message
if (!$conx) {
  die ("MySQL connection failed: ".mysqli_connect_errno());
}
 
?>
