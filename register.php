<!DOCTYPE HTML>
<html>
<head>
<?php header("Content-Type:text/html;charset=gbk"); ?>
<title>��ͬ����ϵͳ ע��</title>
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

// ���������Ĭ������Ϊ��ֵ
$nameErr = $passwordErr = $repeatPasswordErr = "";
$name = $password = $password2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	require_once 'formcheck.php';
	$name = test_input($_POST["name"]);
	$password = test_input($_POST["password"]);
	$password2 = test_input($_POST["password2"]);

	// ����û����Ƿ�Ϊ�ջ�ֻ������ĸ�����ֺ��»���
	$nameErr = validRegisterName($name);
	// ��������Ƿ�Ϊ�ջ�ֻ������ĸ������
	$passwordErr = validPassword($password);

	if ($password2 == "") {
		$repeatPasswordErr = "���ٴ������룡";
	} else if ($password2 != $password) {
		$repeatPasswordErr = "�������벻һ�£�";
	}

	if ($nameErr == "" && $passwordErr == "" && $repeatPasswordErr == "") {
		echo 'register ok!';
	}
}
?>

<!-- header start -->
<div class="header">
<div class="toplinks"><span>[<a href="register.php">ע��</a>][<a
	href="login.php">��¼</a>]</span></div>

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
		<td class="title" colspan="2">�û�ע��</td>
	</tr>
	<tr>
		<td width="120" align="center">�û�����:</td>
		<td><input type="text" name="name" id="name"
			value="<?php echo $name?>"> <span class="error">* <?php echo $nameErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">�û�������������ĸ��ͷ���������Ϊ4(�������֣���ĸ���»���).</td>
	</tr>

	<tr>
		<td align="center">����:</td>
		<td><input type="password" name="password" id="password"
			value="<?php echo $password?>"> <span class="error">* <?php echo $passwordErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">�������������Ե���4������ʹ����ĸ���ֻ�ϣ�ע���Сд��</td>
	</tr>

	<tr>
		<td align="center">�ظ���������:</td>
		<td><input type="password" name="password2" id="password2"
			value="<?php echo $password2?>"><span class="error">* <?php echo $repeatPasswordErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">������һ�����룬��֮ǰ�����뱣��һ��!</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit" value="�ύ" class="button" /></td>
	</tr>
</table>
</div>

</form>
</div>
<!-- main end -->

<div class="footer">
<ul>
	<li><a target="_blank" href="#">��ͬ����ϵͳ</a></li>
	<li>��</li>
	<li><a target="_blank" href="#">����</a></li>
</ul>

<p>Copyright&nbsp;&copy;&nbsp;��ʩ��&nbsp;�̳�&nbsp;Copyright&nbsp;Reserved</p>
</div>
</body>
</html>