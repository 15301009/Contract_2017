<!DOCTYPE HTML>
<html>
<head>
<?php header("Content-Type:text/html;charset=gbk"); ?>
<title>合同管理系统 注册</title>
<link href="css/style.css" rel="stylesheet" media="screen"
	type="text/css" />
<style> 
.error {color: #FF0000;}
</style>
</head>

<body>

<?php
// 定义变量并默认设置为空值
$nameErr = $passwordErr = "";
$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "请输入用户名";
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "只允许字母和空格"; 
        }
    }
       
    if (empty($_POST["password"]))
    {
        $passwordErr = "请输入密码";
    }
    else
    {
        $password = test_input($_POST["password"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- header start -->
<div class="header">
<div class="toplinks"><span>[<a href="register.html">注册</a>][<a
	href="login.html">登录</a>]</span></div>

<h1><img src="images/logo_title.png"
	alt="Contract Management System" /></h1>
</div>
<!-- header end -->

<!-- main start -->
<div class="main">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<div class="register_main">
<table>
	<tr>
		<td class="title" colspan="2">用户注册</td>
	</tr>
	<tr>
		<td width="120" align="center">用户姓名:</td>
		<td><input type="text" name="name" id="name"
			value="<?php echo $name?>" /> <span class="error">* <?php echo $nameErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">用户姓名必须以字母开头，最低字数为4(包括数字，字母，下划线).</td>
	</tr>

	<tr>
		<td align="center">密码:</td>
		<td><input type="password" name="password" id="password"
			value="<?php echo $password?>" /> <span class="error">* <?php echo $passwordErr; ?>
		</span></td>
	</tr>
	<tr>
		<td class="info" colspan="2">密码字数不可以低于6，建议使用字母数字混合，注意大小写！</td>
	</tr>

	<tr>
		<td align="center">重复输入密码:</td>
		<td><input type="password" name="password2" id="password2"
			value="" /></td>
	</tr>
	<tr>
		<td class="info" colspan="2">在输入一次密码，与之前的密码保持一致!</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit" value="提交" class="button" />
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
	<li>｜</li>
	<li><a target="_blank" href="#">帮助</a></li>
</ul>

<p>
Copyright&nbsp;&copy;&nbsp;倪施杰&nbsp;程辰&nbsp;Copyright&nbsp;Reserved</p>
</div>
</body>
</html>