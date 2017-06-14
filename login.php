<!DOCTYPE HTML>
<html>
<head>
<title>��ͬ����ϵͳ ��¼</title>
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

	// ����û����Ƿ�Ϊ�ջ�ֻ������ĸ�����ֺ��»���
	$nameErr = validLoginName($name);
	// ��������Ƿ�Ϊ�ջ�ֻ������ĸ������
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
<div style="color:white" class="toplinks"><span> [<a style="color:white" href="login.php" target="_top">��¼</a>][<a
	style="color:white" href="register.php">ע��</a>] </span></div>


</div>
<!-- header end -->

<!-- main start -->
<div class="main">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
	method="post">

<div class="register_main">
<table>
	<tr>
		<td class="title" colspan="3">�û���¼</td>
	</tr>
	<tr>
		<td width="100">�û���:</td>
		<td width="200"><input type="text" name="name" id="name"
			value="<?php echo $name?>" height="40" /></td>
		<td width="200"><span class="error">* <?php echo $nameErr; ?></span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">�������û������û��������Ȳ���С��4(�������֣���ĸ���»���).</td>
	</tr>

	<tr>
		<td>����:</td>
		<td><input type="password" name="password" id="password"
			value="<?php echo $password?>" height="40" /></td>
		<td><span class="error">* <?php echo $passwordErr; ?></span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">���������룬���볤�Ȳ���С��4(�������֣���ĸ).</td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" value="�ύ" class="button" /></td>
	</tr>
</table>
</div>

</form>
</div>
<!-- main end -->

<div class="footer">
<ul>
	<li><a target="_blank" href="#">��ͬ����ϵͳ</a></li>
	<li>|</li>
	<li><a target="_blank" href="#">����</a></li>
</ul>

<p>Copyright&nbsp;&copy;&nbsp;��ʩ��&nbsp;�̳�&nbsp;Copyright Reserved</p>
</div>
</body>
</html>
