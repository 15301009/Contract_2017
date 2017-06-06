<?php

function validName($name) {
	if (empty($name)) {
		return "请输入用户名！";
	} else if(preg_match("/[^a-zA-Z0-9_]/",$name)) {
		return "只允许字母、数字和下划线";
	} else if (strlen($name) < 4) {
		return "字符数小于4";
	} else if (strlen($name) > 20) {
		return "字符数大于20";
	} else {

		return "";
	}
}

function validRegisterName($name) {
	$err = validName($name);
	if ($err != "") {
		return $err;
	} else {
		require_once 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			
		if ($conn->connect_error) {
			die("连接失败: " . $conn->connect_error);
		} else {
			if (isUserExist($conn, $name)) {
				return "此用户名已存在！";
			} else {
				return "";
			}
		}
	}
}

function validLoginName($name) {
	$err = validName($name);
	if ($err != "") {
		return $err;
	} else {
		require 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			
		if ($conn->connect_error) {
			die("连接失败: " . $conn->connect_error);
		} else {
			if (isUserExist($conn, $name)) {
				return "";
			} else {
				return "用户名不存在！";
			}
		}
	}
}

function validPassword($password) {
	if (empty($password)) {
		return "请输入密码";
	} else if (preg_match("/[^a-zA-Z0-9]/",$password)) {
		return "只允许字母、数字！";
	} else if (strlen($password) < 4) {
		return "密码长度数小于4！";
	} else if (strlen($password) > 20) {
		return "字符数大于20";
	} else {
		return "";
	}
}

function validLoginPassword($name, $password) {
	$err = validPassword($password);
	if ($err != ""){
		return $err;
	} else {
		require 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			
		if ($conn->connect_error) {
			die("连接失败: " . $conn->connect_error);
		} else {
			if (isPasswordCorrect($conn, $name, $password)) {
				return "";
			} else {
				return "密码错误！";
			}
		}
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