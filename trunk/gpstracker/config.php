<?php

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'gps';
$db_collation = 'utf8';
$db_new_session = true;

$db = new Connectdb($db_host, $db_username, $db_password, $db_name, $db_collation);
$condb = $db->condb;

// เป็นการคิวรื่เพื่อทำให้เปลี่ยนแปลงสถานะการจอง ที่มีการจองแล้วไม่ได้รับการยืนยันภายใน 3 วันจะถูกตัดสิทธิ์การจองโดย ค่าสถานะจะเป็น 9

class Connectdb
{
	var $condb;
	public function Connectdb($db_host, $db_username, $db_password, $db_name, $db_collation)
	{
		$this->condb = mysql_connect($db_host, $db_username, $db_password, $db_name) or die (mysql_error());
		
		if ($this->condb)	
		{				
			if (mysql_select_db($db_name,$this->condb))
			{
				mysql_query('SET NAMES '.$db_collation,$this->condb);
				return $this->condb;
			}
			else
				die ('Error : '.mysql_error().__FILE__.__LINE__);
		}
		else
		{
			die ('Error : '.mysql_error().__FILE__.__LINE__);	
		}
	}
	
//เป็น Function ที่สร้างขึ้นมาเพื่อป้องกันการถูก Injection
	function antihack($text)
	{
		return mysql_real_escape_string(htmlspecialchars($text));
	}	
}

?>