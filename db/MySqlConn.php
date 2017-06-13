<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '15301002';
$db_database = 'contractdb';

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
			return "зЂВсГЩЙІ";
		} else {
			return "зЂВсЪЇАм" . $conn->error;
		}
	}
}

?>