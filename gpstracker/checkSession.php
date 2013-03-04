<?php 
session_start();
include('include/classUser.php');

$checkSession = new User();

if(isset($_SESSION['deviceID']) && isset($_SESSION['keyPass']))
{
	$deviceID = $_SESSION['deviceID'];
	$keyPass = $_SESSION['keyPass'];
	
	$result = $checkSession->checkSession($deviceID,$keyPass);
	echo $result;
}

else
{
}

?>