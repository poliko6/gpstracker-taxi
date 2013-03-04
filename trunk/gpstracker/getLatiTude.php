<?php
session_start();
include('config.php');
include('include/classMapCanvas.php');
	$deviceDetailID = $_SESSION['deviceDetailID'];

	$getLatitude = new MapCanvas();
	$result = $getLatitude->gatLatitude($deviceDetailID,$condb);
	
	echo $result;
?>