<?php 
include 'config.php';
	$deviceID=$_GET['deviceIDPost'];
	$positionName = $_GET['positionNamePost'];
    $dating = $_GET['datingPost'];
	$timing = $_GET['timingPost'];
	$rating = $_GET['ratingPost'];
	
	$geoLocationStop = new MapCanvas();
	$result = $geoLocationStop->geoLocationStop($deviceID,$positionName,$dating,$latiTude,$timing,$rating);	
	echo $result;
?>