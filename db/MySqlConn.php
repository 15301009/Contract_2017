<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '15301002';
$db_database = 'contractdb';

if (!function_exists('getNewContractId')) {
	function getNewContractId($conn) {
		$sql = "SELECT COUNT(*) FROM contract";
		$result = $conn->query($sql);
		
		$row = mysqli_fetch_array($result);
		if ($row[0] < 10) {
			return "Con".date("Ymd")."000".$row[0];
		} else if ($row[0] >= 10 && $row[0] < 100) {
			return "Con".date("Ymd")."00".$row[0];
		} else if ($row[0] >= 100 && $row[0] < 1000) {
			return "Con".date("Ymd")."0".$row[0];
		} else {
			return "Cus".date("Ymd").$row[0];
		}
	}
}

if (!function_exists('isUserExist')) {
	function isUserExist($conn, $userName) {
		$sql = "SELECT * FROM user WHERE username = '".$userName."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isCusExist')) {
	function isCusExist($conn, $customername) {
		$sql = "SELECT * FROM customer WHERE customername = '".$customername."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isRoleExist')) {
	function isRoleExist($conn, $rolename) {
		$sql = "SELECT * FROM `role` WHERE rolename = '".$rolename."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isPasswordCorrect')) {
	function isPasswordCorrect($conn, $name, $password) {
		$sql = "SELECT password FROM user WHERE username = '".$name."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_array($result);
			if ($row[0] == $password) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

if (!function_exists('addUser')) {
	function addUser($conn, $userName, $password, $name) {
		$sql = "INSERT INTO user (username, password, name)
				VALUES ('".$userName."', '".$password."', '".$name."')";

		if ($conn->query($sql) === TRUE) {
			return "ע��ɹ�";
		} else {
			return "ע��ʧ��" . $conn->error;
		}
	}
}

?>