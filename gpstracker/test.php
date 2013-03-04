<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script type="text/javascript">// <![CDATA[

	$('.holder input').keypress(function() {
  		$(this).parent().addClass('hassome')
	});

// ]]></script>
<title>Untitled Document</title>
</head>

<body>

<style>
.login {
background-color:#53718b;
padding:50px;
text-align:center;
}

form#twitter {
width:auto;
margin:0 auto;
alignment-baseline:central;
}

.holder {
float:left;
width:160px;
position:relative;
}

.holder.btn {
width:70px;
}

.holder span{
position:absolute;
font-size:10px;
color:#86888b;
left:15px;
top:6px;
text-shadow:1px 1px #fff;
}

form#twitter input[type=text] {
padding:8px 6px;
font-size:10px;
color:#5f6061;

text-shadow:1px 1px #fff;

-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px; /* future proofing */

-khtml-border-radius: 3px; /* for old Konqueror browsers */
border:0 none;

-moz-box-shadow:inset 0 1px 0 #3c556a, inset 0 -1px 0 #e4eaef;
-webkit-box-shadow:inset 0 1px 0 #3c556a, inset 0 -1px 0 #e4eaef;
box-shadow:inset 0 1px 0 #3c556a, inset 0 -1px 0 #e4eaef;

background-color:#d4dee5;

width:140px;
}

form#twitter input[type=submit] {
padding:6px;

font-weight:bold;

text-shadow:1px 1px #fff;

-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px; /* future proofing */
-khtml-border-radius: 5px; /* for old Konqueror browsers */

border:0 none;

-moz-box-shadow:inset 0 -1px 0 #5f666c;
-webkit-box-shadow:inset 0 -1px 0 #5f666c;
box-shadow:inset 0 -1px 0 #5f666c;

/* Firefox 3.6+ */
background-image: -moz-linear-gradient(#fff, #d1d4d6);

/* Safari 4+, Chrome 1+ */
background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#d1d4d6), to(#fff));

/* Safari 5.1+, Chrome 10+ */
background-image: -webkit-linear-gradient(#fff, #d1d4d6);

/* Opera 11.10+ */
background-image: -o-linear-gradient(#fff, #d1d4d6);

background-color:#fff;

cursor:pointer;

}

form#twitter input[type=text]:hover {
background-color:#dce4ea;
}

form#twitter input[type=text]:focus {
color:#5f6061;
background-color:#ecf1f4;

-moz-box-shadow:inset 0 1px 0 #7394b0, inset 0 -1px 0 #fff, 0 0 8px #fff;
-webkit-box-shadow:inset 0 1px 0 #7394b0, inset 0 -1px 0 #fff, 0 0 8px #fff;
box-shadow:inset 0 1px 0 #7394b0, inset 0 -1px 0 #fff, 0 0 8px #fff;
}
I also added some ‘hover’ and ‘active’ states on the submit button.

form#twitter input[type=submit]:hover {
/* Firefox 3.6+ */
background-image: -moz-linear-gradient(#e7eaec, #d1d4d6);

/* Safari 4+, Chrome 1+ */
background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#d1d4d6), to(#e7eaec));

/* Safari 5.1+, Chrome 10+ */
background-image: -webkit-linear-gradient(#e7eaec, #d1d4d6);

/* Opera 11.10+ */
background-image: -o-linear-gradient(#e7eaec, #d1d4d6);

}

form#twitter input[type=submit]:active {
/* Firefox 3.6+ */
background-image: -moz-linear-gradient(#d1d4d6, #fff);

/* Safari 4+, Chrome 1+ */
background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#d1d4d6));

/* Safari 5.1+, Chrome 10+ */
background-image: -webkit-linear-gradient(#d1d4d6, #fff);

/* Opera 11.10+ */
background-image: -o-linear-gradient(#d1d4d6, #fff);
}
.holder.hassome span{
font-size:0px;
opacity: 0;
/* Firefox */
-moz-transition: font-size 0.5s 0.1s, opacity 0s 0s;
/* WebKit */
-webkit-transition: font-size 0.5s 0.1s, opacity 0s 0s;
/* Opera */
-o-transition: font-size 0.5s 0.1s, opacity 0s 0s;
/* Standard */
transition: font-size 0.5s 0.1s, opacity 0s 0s;
}
</style>
<div class="login clearfix">
<form id="twitter" action="#" method="get" name="twitter">
<fieldset>
<div class="holder"><span>Username</span> <input type="text" name="uname" /></div>
<div class="holder"><span>Password</span> <input type="text" name="pword" /></div>
<div class="holder btn"><input type="submit" name="signin" value="Sign In" class="holder btn"/></div></fieldset>
</form></div>
</body>
</html>