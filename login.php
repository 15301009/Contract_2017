<!DOCTYPE HTML>
<html>
<head>
<?php header("Content-Type:text/html;charset=gbk"); ?>
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
		echo 'login ok!';
	}
}
?>

<body>
<!-- header start -->
<div class="header">
<div class="toplinks"><span> [<a href="login.html" target="_top">��¼</a>]
&nbsp;|&nbsp; [<a href="register.html">ע��</a>] </span></div>

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
