<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$name = isset($_POST['rolename']) ? htmlspecialchars($_POST['rolename']) : "";
$description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";
$function = isset($_POST['function']) ? htmlspecialchars($_POST['function']) : "";

$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";

if ($s == "select" && $name ==  "") {
	$sql = "SELECT * FROM `role`";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('rolename' => $row["rolename"], 'description' => $row["description"], 'crttime' => $row["crttime"]);
		}
	}
	$json=json_encode($data);
	echo $json;
}
else if ($s == "select" && $name != ""){
	$sql = "SELECT * FROM `role` WHERE `rolename` = '".$name."'";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('rolename' => $row["rolename"], 'description' => $row["description"], 'function' => $row["function"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if($s == "update" && $name != "") {
	$sql = "UPDATE `role` SET `function` = '".$function."', `description` = '".$description."' WHERE `rolename` = '".$name."'";

	if ($conn->query($sql) == TRUE) {
		echo "修改成功";
	}
	else {
		echo "修改失败";
	}
} else if ($s == "insert" && $name != "") {
	require_once 'formcheck.php';
	$err = validName($name);
	if ($err == "") {
		isRoleExist($conn, $name) ? "角色名已存在!" : "";
	}
	if ($err == "") {
		$stmt = $conn->prepare("INSERT INTO role (rolename, description, function) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $description, $function);

		$stmt->execute();
		echo "插入成功";
	}
	else {
		echo $err;
	}
}
?>