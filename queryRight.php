<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";
$rolename = isset($_POST['rolename']) ? htmlspecialchars($_POST['rolename']) : "";

if ($s == "select" && $username == "") {
	$sql = "SELECT * FROM `user`";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('username' => $row["username"], 'rolename' => $row["rolename"]);
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
			$data[] = array('username' => $row["username"], 'rolename' => $row["rolename"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "update" && $rolename != "") {
	$sql = "UPDATE `user` SET `rolename` = '". $rolename . "' WHERE `username` = '".$username."'";
	
	if ($conn->query($sql) == TRUE) {
		echo "修改成功";
	}
	else {
		echo "修改失败";
	}
}
?>