<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";
$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";
if ($s == "select" && $username == "") {
	$sql = "SELECT * FROM `user`";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('username' => $row["username"], 'name' => $row["name"], 'crttime' => $row["crttime"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "select" && $username != "") {
	$sql = "SELECT * FROM `user` WHERE `username` = '".$username."'";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('username' => $row["username"], 'name' => $row["name"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "update" && $username != "") {
	$sql = "UPDATE `user` SET `name` = '".$name."', `password` = '".$password."' WHERE `username` = '".$username."'";
	require_once 'formcheck.php';
	if (validPassword($password) != "") {
		echo validPassword($password);
	} else {
		if ($conn->query($sql) == TRUE) {
			echo "修改成功";
		}
		else {
			echo "修改失败";
		}
	}
}
?>