<?php 
include('config.php');
include('include/classUser.php');
//test svn gg
	$mapposition=12255;
	$keyPassPost = $_REQUEST['keyPassPost'];
	$deviceIDPost = $_REQUEST['deviceIDPost'];
	$emailPost = $_REQUEST['emailPost'];
	$MailSubject = 'subject';
	$MailMessage = 'MSG';
	$Headers = '777777';
	$MailFrom = 'vendezta@yahoo.com';
	$sendTO = 'vendezta@live.com';	
	$locationNearby= $_GET['locationNearbyPost'];
	$latiTude = 0;
    $longtiTude = 0;
	$speed=$_GET['speedPost'];
	$date=$_GET['datePost'];
	$time=$_GET['timePost'];
	$totalTime=$_GET['totalTimePost'];
	$notificateStatus=$_GET['notificateStatusPost'];

	$sendMailToFollower = new User();
	$result = $sendMailToFollower->sendMailToFollower($mapposition,$keyPassPost,$deviceIDPost,$emailPost,$MailSubject,$MailMessage
			 ,$Headers,$MailFrom,$sendTO,$locationNearby,$latiTude,$longtiTude,$speed,$date,$time,$totalTime,$notificateStatus);	
	echo $result;
?>