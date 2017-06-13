<?php

function validName($name) {
	if (empty($name)) {
		return "�������û�����";
	} else if(preg_match("/[^a-zA-Z0-9_]/",$name)) {
		return "ֻ������ĸ�����ֺ��»���";
	} else if (strlen($name) < 4) {
		return "�ַ���С��4";
	} else if (strlen($name) > 20) {
		return "�ַ�������20";
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
			die("����ʧ��: " . $conn->connect_error);
		} else {
			if (isUserExist($conn, $name)) {
				return "���û����Ѵ��ڣ�";
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
			die("����ʧ��: " . $conn->connect_error);
		} else {
			if (isUserExist($conn, $name)) {
				return "";
			} else {
				return "�û��������ڣ�";
			}
		}
	}
}

function validCusName($name) {
	$err = validName($name);
	if ($err != "") {
		return $err;
	} else {
		require 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			
		if ($conn->connect_error) {
			die("����ʧ��: " . $conn->connect_error);
		} else {
			if (isCusExist($conn, $name)) {
				return "�ͻ����Ѵ��ڣ�";
			} else {
				return "";
			}
		}
	}
}

function validPassword($password) {
	if (empty($password)) {
		return "����������";
	} else if (preg_match("/[^a-zA-Z0-9]/",$password)) {
		return "ֻ������ĸ�����֣�";
	} else if (strlen($password) < 4) {
		return "���볤����С��4��";
	} else if (strlen($password) > 20) {
		return "�ַ�������20";
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
			die("����ʧ��: " . $conn->connect_error);
		} else {
			if (isPasswordCorrect($conn, $name, $password)) {
				return "";
			} else {
				return "�������";
			}
		}
	}
}

function validEmail($email) {
	if (empty($email)) {
		return "����������";
	} else if (!preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$email)) {
		return "�����ʽ����";
	} else {
		return "";
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