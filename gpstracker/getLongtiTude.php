<?php
session_start();
include('config.php');
include('include/classMapCanvas.php');
	$deviceDetailID = $_SESSION['deviceDetailID'];

	$getLongtitude = new MapCanvas();
	$result = $getLongtitude->gatLongtitude($deviceDetailID,$condb);
	
	echo $result;
?>