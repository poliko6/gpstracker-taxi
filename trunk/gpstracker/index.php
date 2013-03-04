<?php
 session_start(); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GPS Tracker [Mr.Taxi]</title>
<LINK REL="SHORTCUT ICON" HREF="http://www.veryicon.com/icon/16/Leisure/Travel/Taxi.png" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
var markers;
var longtiTude;
var latiTude;
var mapOptions;
var map;
var infowindow;
var timer;
var checkSession;
var timerWarning;


//=======================================================================================
$(document).ready(function() {
	$('#result').fadeOut('fast');
	var getCheckSession = $.get('checkSession.php', {},
				function(check)
				{
					checkSession = check;
					if(checkSession == 'true')
					{
						loadMap();
					}
					
					else
					{
						$("#content").removeAttr("style");
					}
				});
				
	
	
	$("#btnLogin").click(function() {
		var action = $("#loginForm").attr('action');
		var form_data = {	deviceId: $("#txDeviceId").val(),
							 keyPass: $("#txKeyPass").val()
						};
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success'){
					setTimeout(function() {
										$("#loginForm").slideUp('slow', function() {
											$("#message").html("<p class='success' align='center'>You have logged in successfully!</p><br><a href='map.php' id='linkMap' >Redirecting...Wait 3 Seconds or click!</a>");
										});
										setTimeout(function() {
											loadMap();
										}, 3000);
									}, 700);
				}	
				else
					$("#message").html("<p class='error' align='center'>Invalid username and/or password.</p>");	
			}
		});
		return false;
	});
});

//=============================================================================
	function loadMap(){
		$('#content').fadeOut('slow');
		$('#p1').hide();
		$('#map').attr("style","width:100%; height:100%");
		$('#result').fadeIn('slow');
		initialize();
	
		google.maps.event.addDomListener(window, 'load', initialize);
		timer = setTimeout("inited()", 1000);	
		timerWarning = setInterval("checkWarningStatus()", 60000);
	}

	function checkWarningStatus()
	{
		$.get('checkNotificate.php',{},
		function(data)
		{
			if(data == 1)
			{
				$('#status').html("<font color='green'> ปกติ</font>");
			}
			else if(data == 2)
			{
				$('#status').html("<font color='orange'> ระวัง</font>");
                $('#overlay1').fadeIn('fast',function(){
                        $('#boxs1').animate({'top':'160px'},1000);
					//	clearTimeout(timerWarning);
						setTimeout(function(){
							
							$('#boxsclose1').click();
						},15000);
                    });
			$('#boxsclose1').click(function(){
                    $('#boxs1').animate({'top':'-400px'},1000,function(){
                        $('#overlay1').fadeOut('fast');
                    });
                });
			}
			else if(data == 3)
			{
				$('#status').html("<font color='red'> อันตราย</font>");
                $('#overlay').fadeIn('fast',function(){
                        $('#boxs').animate({'top':'160px'},1000);
					//	clearTimeout(timerWarning);
						setTimeout(function(){
							
							$('#boxsclose').click();
						},15000);
                    });
			$('#boxsclose').click(function(){
                    $('#boxs').animate({'top':'-400px'},1000,function(){
                        $('#overlay').fadeOut('fast');
                    });
                });
				
				
			}
			
			else if(data == 4)
			{
				
			}
			else
			{
				
			}
		});
		
	}
//===============================================================================
	function initialize(){	

		var getLatiTude = $.get('getLatiTude.php', {},
			function(data1)
			{
				latiTude = data1;	
				$("#latiTude").html("[ "+latiTude+" ]"); 	
				var getLongtiTude = $.get('getLongtiTude.php', {},
				function(data2)
				{
					longtiTude = data2;
					mapOptions = {
					center: new google.maps.LatLng(latiTude,longtiTude),
					zoom: 18,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				google.maps.event.addDomListener(window, 'load', initialize);
				map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
				infowindow = new google.maps.InfoWindow();
				markers = new google.maps.Marker({
					title: 'GPS',
					label: 'GPS',
					icon: 'http://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Ball-Azure.png',
					position: new google.maps.LatLng(latiTude,longtiTude),
					map: map
				});
			});
		});
      }
//=====================================================================================	 
	 function inited()
	 {				
		var getLatiTude = $.get('getLatiTude.php', {},
			function(data1)
			{
				latiTude = data1;	
				$("#latiTude").html("[ "+latiTude+" ]");  	
				
				var getLongtiTude = $.get('getLongtiTude.php', {},
				function(data2)
				{
					longtiTude = data2;
					$("#longtiTude").html("[ "+longtiTude+" ]"); 
						
					timer = setTimeout("inited()", 1000);			
					var newLatlong = new google.maps.LatLng(latiTude, longtiTude);
					map.setCenter(newLatlong);
					markers.setPosition(newLatlong);
					$("#message").html("");
			});
		});
	} 

//==============================================================================
	function logOut()
	{
		var logOut = $.get('doLogout.php',{},
		function(msg)
		{
			
			if(msg == 'true')
			{
				$('#result').fadeOut('fast');
				$('#map').fadeOut('fast');
				$('#p1').fadeIn('slow');
				$('#content').fadeIn('slow');
				
				
				$("#loginForm").slideDown('slow', function() 
									{
										});
										
			}
		});
	}
	 
</script>
</head>

<body>
<style type="text/css">
html{
	height:100%;
	
}
body{
	height:90%;
	margin:0px;
	padding:0px;

	}
result {

	bottom:0px;
}
map_cannvas{
	height:100%;
}
</style>

<img src="http://i183.photobucket.com/albums/x171/4all2all/Loader%20Icons/Loadinfo2.gif" width="0" height="0" />       
<!-- 1111111111111 DIV OVER DANGER  11111111111111111 -->     
	<div class="overlay" id="overlay" style="display:none;"></div>
        <div class="boxs" id="boxs">
            <a class="boxsclose" id="boxsclose"></a>
            <h1>อันตราย !</h1>
            <p>
               <div>
               	<center><img src="images/Danger.png" /></center>
               </div>
            </p>
</div><!-- 1111111111111 DIV OVER WARNING  11111111111111111 -->     
	<div class="overlay1" id="overlay1" style="display:none;"></div>
        <div class="boxs1" id="boxs1">
            <a class="boxsclose1" id="boxsclose1"></a>
            <h1>ระวัง !</h1>
            <p>
               <div>
               	<center><img src="images/icones_00728.png"/></center>
               </div>
            </p>
        </div>
        
        
<p id="p1">&nbsp;</p>


<div id="map"><div id="map_canvas" style="width:100%; height:100%"></div>
    <div id="result" align="center" style="background:url(bg.png); width:100%; height:10%" hidden="">
    	<table width="auto">
        <tr>
        	<td>latiTude :</td>
            <td><div id="latiTude"></div> </td>
            
        	<td> &nbsp;&nbsp;&nbsp;longtiTude :</td>
        	<td> <div id="longtiTude"></div></td>
        </tr>
        <tr>
            <td>สถานะ : </td>
            <td><div id="status"></div>
            <td></td>
            <td></td>
        </tr>
        </table>
         <div><input type="button" name="logOut" id="logOut" value="   LOGOUT   " onclick="logOut();" /></div>  
    </div>
</div>


<div id="content" style="visibility:hidden">

  <h1>Login Tracker</h1>
  
  <form id="loginForm" name="loginForm" action="doLogin.php" method="post" ><hr />
    <p>
    <table border="0" cellpadding="3" cellspacing="3" align="center">
    	<tr>
      		<td align="right"><label for="txDeviceId" class="tx">Device : </label></td>
     		<td><input type="text" name="txDeviceId" id="txDeviceId" value="<?php if(isset($_GET['deviceID'])) { echo $_GET['deviceID']; } else { echo '';} ?>" class="box" /></td> 
        </tr>
    	<tr>
      		<td align="right"><label for="txKeyPass" class="tx">PIN : </label></td>
      		<td><input type="text" name="txKeyPass" id="txKeyPass" value="<?php if(isset($_GET['keyPass'])) { echo $_GET['keyPass']; } else { echo '';} ?>" class="box" maxlength="8"/></td>
        </tr> 
        
    </table>
    
       	
	<p align="center"><input type="button" id="btnLogin" name="btnLogin" value="   Tracker   " class="btTrack"/>
    </p>
  </form>
    <div id="message"></div>
    
    
        
</div>
    </div>
</body>
</html>