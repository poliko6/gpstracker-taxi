<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>GPS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css">

html{
	height:100%;
	
}
body{
	height:90%;
	margin:0px;
	padding:0px;
	}
map_cannvas{
	height:100%;
}


  </style>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript">
  
  
  
     function initialize() 
	 {		
		var mapOptions = {
			center: new google.maps.LatLng(13.736959,100.551534),
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

		var markers = new Array();
		var infowindow = new google.maps.InfoWindow();

		markers[0] = new google.maps.Marker({
			title: 'GPS',
			label: 'GPS',
			position: new google.maps.LatLng(13.736959,100.551534),
			map: map
		});

		google.maps.event.addListener(markers[0], 'click', function() 
		{			
			content = '<font color="blue"><b>พิกัด: ' + this.getPosition();

			infowindow.setContent(content);
			infowindow.open(map, markers[0]);
			map.setCenter(markers[0].getPosition());
			show_left(markers[0].markerid);
		});
      }
	  


function show()
{
	$('#result').html('');
	var url = 'here.php'
	$.getJSON(url,
		function(data)
		{
			$.each(data,
				function(i,field)
				{
					var pointer = i+1;
					$('#result').html
						($('#result').html() + 'ลำดับที่ : '+ pointer+'. ' + 
												'<br>ชื่อผู้ใช้ : '+field.longtiTude											
					);				
				}
			);
		}
	);
}

  </script>
<!--[if lt IE 7]>
   <script type="text/javascript" src="ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png, .logo h1, .box .left-top-corner, .box .right-top-corner, .box .left-bot-corner, .box .right-bot-corner, .box .border-left, .box .border-right, .box .border-top, .box .border-bot, .box .inner, .special dd, #contacts-form input, #contacts-form textarea');
   </script>
<![endif]-->
</head>

<body id="page6"  onload="initialize();">
   <!-- header --><!-- content -->
                 <div id="map_canvas" style="width:100%; height:100%"></div>
                 <div id="result" align="center"></div>
</body>
</html>