<?php
session_start();
include('config.php');
$getPosition = mysql_query('SELECT latiTude, longtiTude FROM devicedetail WHERE deviceDetailID = "'.$_SESSION['deviceDetailID'].'" ')or die(mysql_error());
	list($latiTude ,$longtiTude ) = mysql_fetch_row($getPosition);
	
	echo $latiTude.','.$longtiTude;
?>