<!DOCTYPE HTML>
<html>
<head>
<title>合同管理系统 注册</title>
<link href="css/style.css" rel="stylesheet" media="screen"
	type="text/css" />

<style type="text/css">
.error {
	color: #FF0000;
}
</style>

</head>

<body>

<?php
header("Content-Type:text/html;charset=gbk");
session_start();
// 定义变量并默认设置为空值
$feedback = $usernameErr = $passwordErr = $repeatPasswordErr = $name = "";
$username = $password = $password2 = $nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	require_once 'formcheck.php';
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$password2 = test_input($_POST["password2"]);
	$name = test_input($_POST['name']);

	// 检测用户名是否为空或只包含字母、数字和下划线
	$usernameErr = validRegisterName($username);
	// 检测密码是否为空或只包含字母和数字
	$passwordErr = validPassword($password);
	
	$nameErr = validName($name);

	if ($password2 == "") {
		$repeatPasswordErr = "请再次输密码！";
	} else if ($password2 != $password) {
		$repeatPasswordErr = "两次密码不一致！";
	}

	if ($nameErr == "" && $usernameErr == "" && $passwordErr == "" && $repeatPasswordErr == "") {
		$_SESSION['name'] = $name;
		require 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
		
		if ($conn->connect_error) {
			$feedback = "操作失败: " . $conn->connect_error;
		} else {
			$feedback = addUser($conn, $username, $password, $name);
			header("refresh:1;url=newUser.php");
		}
	}
}
?>

<!-- header start -->
<div class="header">
<div class="toplinks" style="color:white"><span>[<a style="color:white" href="register.php">注册</a>][<a
	style="color:white" href="login.php">登录</a>]</span></div>

<h1><img src="images/logo_title.png" alt="Contract Management System" /></h1>
</div>
<!-- header end -->

<!-- main start -->
<div class="main">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">

<div class="register_main">
<table>
	<tr>
		<td class="title" colspan="2">用户注册</td>
	</tr>
	<tr>
		<td width="120" align="center">用户名:</td>
		<td><input type="text" name="username" id="username"
			value="<?php echo $username?>"> <span class="error">* <?php echo $usernameErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">用户名唯一且最低字数为4，最长为20(包括数字，字母，下划线).</td>
	</tr>
	
	<tr>
		<td width="120" align="center">姓名:</td>
		<td><input type="text" name="name" id="name"
			value="<?php echo $name?>"> <span class="error">* <?php echo $nameErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">姓名可重复，最低字数为4，最长为20(包括数字，字母，下划线).</td>
	</tr>

	<tr>
		<td align="center">密码:</td>
		<td><input type="password" name="password" id="password"
			value="<?php echo $password?>"> <span class="error">* <?php echo $passwordErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">密码字数不可以低于4，不可超过20，建议使用字母数字混合，注意大小写！</td>
	</tr>

	<tr>
		<td align="center">重复输入密码:</td>
		<td><input type="password" name="password2" id="password2"
			value="<?php echo $password2?>"><span class="error">* <?php echo $repeatPasswordErr; ?>
		</span></td>
	</tr>  
	<tr>
		<td class="info" colspan="2">再输入一次密码，与之前的密码保持一致!</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit" value="提交" class="button" /><span class="error">* <?php echo $feedback; ?>
		</span></td>
	</tr>
</table>
</div>

</form>
</div>
<!-- main end -->

<div class="footer">
<ul>
	<li><a target="_blank" href="#">合同管理系统</a></li>
	<li>｜</li>
	<li><a target="_blank" href="#">帮助</a></li>
</ul>

<p>Copyright&nbsp;&copy;&nbsp;倪施杰&nbsp;程辰&nbsp;Copyright&nbsp;Reserved</p>
</div>
</body>
</html>
