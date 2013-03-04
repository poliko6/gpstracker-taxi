<?php
session_start();
include('include/classUser.php');
	$deviceID		= $_SESSION['deviceID'];
	$keyPass		 = $_SESSION['keyPass'];
	$deviceDetailID  = $_SESSION['deviceDetailID'];
	$statusID 		= $_SESSION['statusID'];
	
	$doLogout = new User();
	$result = $doLogout->doLogout($deviceID,$keyPass,$deviceDetailID,$statusID);
	echo $result;
?>