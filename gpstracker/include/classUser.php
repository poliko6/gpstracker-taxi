<?php
class User
{
	function checkSession($deviceID, $keyPass)
	{
		if(isset($keyPass) && isset($deviceID))
		{
			return 'true';
		}
		else
		{
			return 'false';
		}
	}
	
	function doLogin($deviceId,$keyPass)
	{
		$checkDeviceId = mysql_query('SELECT deviceID, keyPass, deviceDetailID, statusID
								  FROM device 
								  WHERE deviceID = "'.$deviceId.'" 
								  AND keyPass = "'.$keyPass.'" 
								  LIMIT 1')or die(mysql_error());							  	
		if( mysql_num_rows($checkDeviceId) == 1 )
		{
			list($deviceID, $keyPasss, $deviceDetailID, $statusID) = mysql_fetch_row($checkDeviceId);
			
			$_SESSION['deviceID']   			=	$deviceID;
			$_SESSION['keyPass']			 =	$keyPasss;
			$_SESSION['deviceDetailID']	  = 	$deviceDetailID;
			$_SESSION['statusID']			= 	$statusID;
			$count = "success";	
		}	
		else
		{	
			$count = 'fales';
		}
		echo $count;
	}
	
	function doLogout($deviceID,$keyPass,$deviceDetailID,$statusID)
	{
		if(isset($deviceID) && isset($keyPass) && isset($deviceDetailID) && isset($statusID))
		{
				unset($_SESSION['deviceID']);
				unset($_SESSION['keyPass']);
				unset($_SESSION['deviceDetailID']);
				unset($_SESSION['statusID']);	
				echo 'true';
		}
		else
		{
			echo 'false';
		}
	}

	function sendMailToFollower($mapposition,$keyPassPost,$deviceIDPost,$emailPost,$MailSubject,$MailMessage,$Headers,$MailFrom
			,$sendTO,$locationNearby,$latiTude,$longtiTude,$speed,$date,$time,$totalTime,$notificateStatus)
	{
		$deviceDetailIDUpdateDevice;
		$deviceDetailIDCreateDevice;
		if(isset($keyPassPost) && isset($deviceIDPost) && isset($emailPost))
		{
			foreach ($emailPost as $key=>$value) 
			{
				$strTo = $value;
				$strSubject = '=?UTF-8?B?'.base64_encode('ข้อมูลการติดตาม Mr.Taxi.').'?=';
				$strHeader .= "MIME-Version: 1.0' . \r\n";
				$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
				$strHeader .= 'From: info@iservice4U.com';
				$strMessage .= "รหัสผ่าน : ".$keyPassPost."<br/> รหัสเครื่อง : ".$deviceIDPost."<br/>";
				$strMessage .= '<a href="www.rootcybersolutions.com/android/Taxi/index.php?deviceID='.$deviceIDPost.'&&keyPass='.$keyPassPost.'"/>
				www.rootcybersolutions.com/android/Taxi/index.php?deviceID='.$deviceIDPost.'&&keyPass='.$keyPassPost.' </a> <br/> หากคลิกไม่ได้ให้ Copy ไปวาง URL '; 
				$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
				if($flgSend)
				{
					echo "Email Sending.";
					$query = mysql_query('SELECT deviceDetailID FROM device WHERE deviceID = "'.$deviceIDPost.'"') or die(mysql_error());
					while($fetch = mysql_fetch_array($query))
					{
					 $deviceDetailIDUpdateDevice=$fetch["deviceDetailID"];
					}
					if(empty($deviceDetailIDUpdateDevice))
					{
						$result = mysql_query('INSERT INTO devicedetail(locationName, latiTude, longtiTude, speed, date, time, totalTime, notificateStatusID)
						VALUES("'.$locationNearby.'",
							  "'.$latiTude.'",
							  "'.$longtiTude.'",
							  "'.$speed.'",
							  "'.$date.'",
							  "'.$time.'",
							  "'.$totalTime.'",
							  "'.$notificateStatus.'")'); 
						// check if row inserted or not
						if ($result) 
						{
							// successfully inserted into database
							$response["success"] = 1;
							$response["message"] = "Device successfully created.";
							$result = mysql_query('SELECT deviceDetailID FROM devicedetail')or die(mysql_error());
							while ($row = mysql_fetch_array($result))
							{
								 $deviceDetailIDCreateDevice=$row["deviceDetailID"];
							}		
						  $result = mysql_query('INSERT INTO device(deviceID, keyPass, deviceDetailID, statusID)
						VALUES("'.$deviceIDPost.'",
							  "'.$keyPassPost.'",
							  "'.$deviceDetailIDCreateDevice.'",
							  "1")'); 
						} 
						else 
						{
							// failed to insert row
							$response["success"] = 0;
							$response["message"] = "Oops! An error occurred.";
						}
					}
					else
					{	
						// mysql update row with matched pid
						$result = mysql_query("UPDATE devicedetail SET locationName = '$locationNearby',
						latiTude = '$latiTude', longtiTude = '$longtiTude', speed = '$speed', 
						date = '$date', time = '$time', totalTime = '$totalTime', notificateStatusID = '$notificateStatus'
						WHERE deviceDetailID = '$deviceDetailIDUpdateDevice'");
						// check if row inserted or not
						if ($result) 
						{
							// successfully updated
							$response["success"] = 1;
							$response["message"] = "DeviceDetail Data successfully updated.";
							$result = mysql_query("UPDATE device SET keyPass = '$keyPassPost'
							WHERE deviceID = '$deviceIDPost'");
							if ($result) 
							{
								// successfully updated
								$response["success"] = 1;
								$response["message"] = "KeyPass Data successfully updated.";
							} 
							else
							{				
								$response["success"] = 0;
								$response["message"] = "KeyPass Data not updated.";
							}
						} 
						else 
						{
							$response["success"] = 0;
							$response["message"] = "DeviceDetail Data not updated.";
						}
					}
				}
				else
				{
					echo "Email Can Not Send.";
				}
			}
		}
	}
}
?>