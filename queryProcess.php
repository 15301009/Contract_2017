<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : "";
$contractId = isset($_POST['contractId']) ? htmlspecialchars($_POST['contractId']) : "";

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
} else if($s == "insertprocess") {
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
	echo "²Ù×÷³É¹¦";
}
?>