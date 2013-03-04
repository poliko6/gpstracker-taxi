<?php
class MapCanvas
{
	function gatLatitude($deviceDetailID,$condb)
	{
		$getPosition = mysql_query('SELECT latiTude FROM devicedetail WHERE deviceDetailID = "'.$deviceDetailID.'" ')or die(mysql_error());
		list($latiTude) = mysql_fetch_row($getPosition);
		
		return $latiTude;
	}
	
	function gatLongtitude($deviceDetailID,$condb)
	{
		$getPosition = mysql_query('SELECT longtiTude FROM devicedetail WHERE deviceDetailID = "'.$deviceDetailID.'" ')or die(mysql_error());
		list($longtiTude) = mysql_fetch_row($getPosition);
		
		return $longtiTude;
	}

	function geoLocationStart($deviceID,$keyPass,$locationNearby,$latiTude,$longtiTude,$speed,$date,$time,$totalTime,$notificateStatus,$statusID)
	{
		$deviceDetailIDUpdateDevice;
		$deviceDetailIDCreateDevice;
		$query = mysql_query('SELECT deviceDetailID FROM device WHERE deviceID = "'.$deviceID.'"') or die(mysql_error());
		while($fetch = mysql_fetch_array($query))
		{
			 $deviceDetailIDUpdateDevice=$fetch["deviceDetailID"];
		}
		echo 'detailID : '.$deviceDetailIDUpdateDevice;
		if(empty($deviceDetailIDUpdateDevice))
		{
			echo '<br>Not Find Device<br>';
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
					echo 'DEvice: '.$deviceDetailIDCreateDevice;
				}
				$result = mysql_query('INSERT INTO device(deviceID, keyPass, deviceDetailID, statusID)
				VALUES("'.$deviceID.'",
				  "'.$keyPass.'",
				  "'.$deviceDetailIDCreateDevice.'",
				  "'.$statusID .'")'); 
				// echoing JSON response
				echo json_encode($response);
			} 
			else 
			{
				// failed to insert row
				$response["success"] = 0;
				$response["message"] = "Oops! An error occurred.";
				// echoing JSON response
				echo json_encode($response);
			}
		}
		else
		{
			echo  'ID : '.$deviceDetailIDUpdateDevice;
			echo '<br>Device Finding Complete<br>';
			 // mysql update row with matched pid
			$result = mysql_query("UPDATE devicedetail SET locationName = '$locationNearby',
			latiTude = '$latiTude', longtiTude = '$longtiTude', speed = '$speed', 
			date = '$date', time = '$time', totalTime = '$totalTime', notificateStatusID = '$notificateStatus'
			WHERE deviceDetailID = $deviceDetailIDUpdateDevice");
			 // check if row inserted or not
  			if ($result) 
			{
       			// successfully updated
       			$response["success"] = 1;
       			$response["message"] = "DeviceDetail Data successfully updated.";
				$resultUpdateDevice = mysql_query("UPDATE device SET statusID = '$statusID'
					WHERE deviceDetailID = $deviceDetailIDUpdateDevice");
				if ($resultUpdateDevice) 
				{
       			 // successfully updated
       				$response["success"] = 1;
       				$response["message"] = "device Data successfully updated.";
				}
				else
				{
					$response["success"] = 0;
       				$response["message"] = "device Data not updated.";
				} 
				echo json_encode($response);
			} 
			else 
			{
				$response["success"] = 0;
       			$response["message"] = "DeviceDetail Data not updated.";
				echo json_encode($response);
			}
		}
	}

	function geoLocationStop($deviceID,$positionName,$dating,$latiTude,$timing,$rating)
	{
		$positionIDCheck;
		$result = mysql_query('INSERT INTO mapposition(mapPositionDetail) VALUES("'.$positionName.'")'); 	  
		// check if row inserted or not
		if ($result) 
		{
			// successfully inserted into database
			$response["success"] = 1;
			$response["message"] = "Position successfully created.";
			$result = mysql_query('SELECT mapPositionID FROM mapposition')or die(mysql_error());
			while ($row = mysql_fetch_array($result))
			{
				$positionIDCheck=$row["mapPositionID"];
			}		
			echo 'pos : '.$positionIDCheck;
			$result = mysql_query('INSERT INTO rate(dating, timing, rating, deviceID, mapPositionID)
			VALUES("'.$dating.'",
				  "'.$timing.'",
				  "'.$rating.'",
				  "'.$deviceID.'",
				  "'.$positionIDCheck.'")'); 
			// echoing JSON response
			echo json_encode($response);
		} 
		else 
		{
			// failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
			echo json_encode($response);
		}
	}
}
?>