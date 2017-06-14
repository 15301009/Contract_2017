<!DOCTYPE HTML>
<html>
<head>
<title>合同管理系统 登录</title>
<link href="css/style.css" rel="stylesheet" media="screen"
	type="text/css" />
<script type="text/javascript">  
 			// Make the page as the parent window display
 			if(top!=self){
 				top.location.href=self.location.href;
 			}  
  		</script>
<style type="text/css">
.error {
	color: #FF0000;
}
</style>
</head>

<?php
header("Content-Type:text/html;charset=gbk");
session_start();
$nameErr = $passwordErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	require_once 'formcheck.php';
	$name = test_input($_POST["name"]);
	$password = test_input($_POST["password"]);

	// 检测用户名是否为空或只包含字母、数字和下划线
	$nameErr = validLoginName($name);
	// 检测密码是否为空或只包含字母和数字
	if ($nameErr == "") {
		$passwordErr = validLoginPassword($name, $password);
	}

	if ($nameErr == "" && $passwordErr == "") {
		$_SESSION['name'] = $name;
		require 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

		$sql = "SELECT rolename FROM user WHERE username = '".$name."'";
		$result = $conn->query($sql);
		$role;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$role = $row["rolename"];
			}
		}
		if ($role == "admin") {
			header("refresh:1;url=frame1.html");
		} else if($role == "operator"){
			header("refresh:1;url=frame2.html");
		} else if ($role == "") {
			header("refresh:1;url=newUser.php");
		}
	}

}
?>

<body>
<!-- header start -->
<div class="header">
<div style="color:white" class="toplinks"><span> [<a style="color:white" href="login.php" target="_top">登录</a>][<a
	style="color:white" href="register.php">注册</a>] </span></div>


</div>
<!-- header end -->

<!-- main start -->
<div class="main">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">

<div class="register_main">
<table>
	<tr>
		<td class="title" colspan="3">用户登录</td>
	</tr>
	<tr>
		<td width="100">用户名:</td>
		<td width="200"><input type="text" name="name" id="name"
			value="<?php echo $name?>" height="40" /></td>
		<td width="200"><span class="error">* <?php echo $nameErr; ?></span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">请输入用户名，用户姓名长度不可小于4(包括数字，字母，下划线).</td>
	</tr>

	<tr>
		<td>密码:</td>
		<td><input type="password" name="password" id="password"
			value="<?php echo $password?>" height="40" /></td>
		<td><span class="error">* <?php echo $passwordErr; ?></span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">请输入密码，密码长度不可小于4(包括数字，字母).</td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" value="提交" class="button" /></td>
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
