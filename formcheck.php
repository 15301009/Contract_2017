<?php

function validRegisterName($name) {
	if (empty($name)) {
		return "�������û�����";
	} else if(preg_match("/[^a-zA-Z0-9_]/",$name)) {
		return "ֻ������ĸ�����ֺ��»���";
	} else if (strlen($name) < 4) {
		return "�ַ���С��4";
	} else {
		require_once 'MySqlConn.php';
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
	if (empty($name)) {
		return "�������û�����";
	} else if(preg_match("/[^a-zA-Z0-9_]/",$name)) {
		return "ֻ������ĸ�����ֺ��»���";
	} else if (strlen($name) < 4) {
		return "�ַ���С��4";
	} else {
		require 'MySqlConn.php';
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

function validPassword($password) {
	if (empty($password)) {
		return "����������";
	} else if (preg_match("/[^a-zA-Z0-9]/",$password)) {
		return "ֻ������ĸ�����֣�";
	} else if (strlen($password) < 4) {
		return "���볤����С��4��";
	} else {
		return "";
	}
}

function validLoginPassword($name, $password) {
	$err = validPassword($password);
	if ($err != ""){
		return $err;
	} else {
		require 'MySqlConn.php';
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

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>