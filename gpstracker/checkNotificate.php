<?php
session_start();
include('config.php');
$checkWarning = mysql_query('SELECT notificateStatusID FROM devicedetail WHERE devicedetailID = "'.$_SESSION['deviceDetailID'].'" ')or die(mysql_error());
list($notificateStatusID) = mysql_fetch_row($checkWarning);

echo $notificateStatusID;
?>