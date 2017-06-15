<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : "";
$contractId = isset($_POST['contractId']) ? htmlspecialchars($_POST['contractId']) : "";
$opinion = isset($_POST['opinion']) ? htmlspecialchars($_POST['opinion']) : "";

if($s == "selectprocess") {
	$sql = "SELECT * FROM contract_process WHERE contractId = '".$contractId."'";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('contractname' => $row["contractname"], 'customername' => $row["customername"],
			'begintime' => $row["begintime"], 'endtime' => $row["endtime"], 'content' => $row["content"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "asigning") {
	$sql = "SELECT c.contractId , contractname, drafttime FROM contract c where c.contractId NOT IN(SELECT contractId FROM contract_process)";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('contractId' => $row["contractId"], 'contractname' => $row["contractname"], 'drafttime' => $row["drafttime"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "asigned") {
	$sql = "SELECT c.contractId , contractname, drafttime FROM contract c where c.contractId IN(SELECT contractId FROM contract_process)";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('contractId' => $row["contractId"], 'contractname' => $row["contractname"], 'drafttime' => $row["drafttime"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if($s == "insertprocess") {
	$sql = "SELECT * FROM contract_process WHERE contractId = '".$contractId."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "权限已分配！";
	} else {
		$str1 = explode(",", $type);
		$str2 = explode(",", $username);
		$user;
		$ty;
		$stmt = $conn->prepare("INSERT INTO contract_process (contractId, username, type, state) VALUES (?, ?, ?, ?)");

		$stmt->bind_param("ssss", $contractId, $user, $ty, $state);
		for ($i = 0;$i < 3;$i++) {
			$user = $str2[$i];
			$ty = $str1[$i];
			$stmt->execute();
		}

		$stmt->close();
		echo "操作成功";
	}
} else if ($s == "select") {
	session_start();
	$name = $_SESSION['name'];
	$sql = "SELECT * FROM contract_process WHERE contractId = '".$contractId."' AND type = '".$type."' AND username ='".$name."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo true;
	} else {
		echo false;
	}
} else if ($s == "selectuser") {
	session_start();
	$name = $_SESSION['name'];
	echo $name;
} else if($s == "update") {
	session_start();
	$name = $_SESSION['name'];
	if ($state == "") {
		$sql = "UPDATE contract_process SET opinion = '".$opinion."' WHERE contractId = '".$contractId."' AND type = '".$type."' AND username ='".$name."'";
	} else {
		$sql = "UPDATE contract_process SET opinion = '".$opinion."', state = '".$state."' WHERE contractId = '".$contractId."' AND type = '".$type."' AND username ='".$name."'";
	}
	
	$sql1 = "UPDATE contract_state SET type = '".$type."' WHERE contractId = '".$contractId."'";
	
	if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE) {
		echo true;
	} else {
		echo false;
	}
} else if ($s == "selectopinion") {
	$sql = "SELECT username, opinion FROM contract_process WHERE contractId = '".$contractId."' AND type='".$type."'";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('username' => $row["username"], 'opinion' => $row["opinion"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "selectstate") {
	$sql = "SELECT state FROM contract_process WHERE contractId = '".$contractId."' AND type='".$type."'";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('state' => $row["state"]);
		}
	}
	$json=json_encode($data);
	echo $json;
}
?>