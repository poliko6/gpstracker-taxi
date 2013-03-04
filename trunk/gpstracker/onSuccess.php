<?php
include('config.php');
include('include/classMapCanvas.php');

	$deviceID=$_GET['deviceIDPost'];
	$keyPass=$_GET['keyPassPost'];
	$locationNearby= $_GET['locationNearbyPost'];
	$latiTude = $_GET['latiPost'];
    $longtiTude = $_GET['longtiPost'];
	$speed=$_GET['speedPost'];
	$date=$_GET['datePost'];
	$time=$_GET['timePost'];
	$totalTime=$_GET['totalTimePost'];
	$notificateStatus=$_GET['notificateStatusPost'];
	$statusID = $_GET['statusIDPost'];

	$geoLocationStart = new MapCanvas();
	$result = $geoLocationStart->geoLocationStart($deviceID,$keyPass,$locationNearby,$latiTude,$longtiTude,$speed,$date,$time,$totalTime,$notificateStatus,$statusID);	
	echo $result;
?>