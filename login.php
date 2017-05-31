<!DOCTYPE HTML>
<html>
<head>
<?php header("Content-Type:text/html;charset=gbk"); ?>
<title>合同管理系统 登录</title>
<link href="css/style.css" rel="stylesheet" media="screen"
	type="text/css" />
<script type="text/javascript">  
 			// Make the page as the parent window display
 			if(top!=self){
 				top.location.href=self.location.href;
 			}  
  		</script>
</head>

<body>
<!-- header start -->
<div class="header">
<div class="toplinks"><span> [<a href="login.html"
	target="_top">登录</a>] &nbsp;|&nbsp; [<a href="register.html">注册</a>] </span></div>

<h1><img src="images/logo_title.png"
	alt="Contract Management System" /></h1>
</div>
<!-- header end -->

<!-- main start -->
<div class="main">
<form action="#" method="post">

<div class="register_main">
<table>
	<tr>
		<td class="title" colspan="3">用户登录</td>
	</tr>
	<tr>
		<td width="60">用户名:</td>
		<td width="200"><input type="text" name="name" id="name" value=""
			height="40" /></td>
		<td width="200"></td>
	</tr>

	<tr>
		<td>密码:</td>
		<td><input type="password" name="password" id="password" value=""
			height="40" /></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" value="提交" class="button" />
		</td>
	</tr>
</table>
</div>

</form>
</div>
<!-- main end -->

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