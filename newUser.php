<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>Contract Management System - New User</title>
<link href="css/frame.css" rel="stylesheet" type="text/css" />
<script
	src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">
function currentTime(){
	var d = new Date(),str = '当前时间:';
	str += d.getFullYear()+'年';
	str += d.getMonth() + 1+'月';
	str += d.getDate()+'日';
	str += d.getHours()+'时'; 
	str += d.getMinutes()+'分'; 
	str += d.getSeconds()+'秒'; 
	return str;
}

$(document).ready(function() {
	setInterval(function(){$('#time').html(currentTime)},1000);
	$(".content").css({"font-size": "25","font-family": "华文中宋"});
});
</script>
<div class="header">
<div class="toplinks"><span>Hello:<?php session_start(); echo $_SESSION['name'];?>, 欢迎来到合同管理系统! [<a href="login.php" target="_top">Logout</a>]</span></div>
<h1><img src="images/logo_title.png"
	alt="Contract Management System" /></h1>
</div>

<div class="content">
<br /><br /><br />
<div id="welcome"  style="float:right;">你当前没有任何权限,请等待管理员赋予!</div>
<br /><br /><br /><br />
<div id="time"  style="float:right;"></div>
</div>

<div class="footer">
<ul>
	<li><a target="_blank" href="#">合同管理系统</a></li>
	<li>|</li>
	<li><a target="_blank" href="#">帮助</a></li>
</ul>

<p>Copyright&nbsp;&copy;&nbsp;倪施杰&nbsp;程辰&nbsp;Copyright Reserved</p>
</div>
</body>
</html>