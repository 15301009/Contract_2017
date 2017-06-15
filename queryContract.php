<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$contractId = isset($_POST['contractId']) ? htmlspecialchars($_POST['contractId']) : "";
$contractname = isset($_POST['contractname']) ? htmlspecialchars($_POST['contractname']) : "";
$customername = isset($_POST['customername']) ? htmlspecialchars($_POST['customername']) : "";
$begintime = isset($_POST['begintime']) ? htmlspecialchars($_POST['begintime']) : "";
$endtime = isset($_POST['endtime']) ? htmlspecialchars($_POST['endtime']) : "";
$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : "";

$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";


if ($s == "insert") {
	session_start();
	$name = $_SESSION['name'];
	$contractId = getNewContractId($conn);
	$stmt = $conn->prepare("INSERT INTO contract (contractId, customername, contractname, begintime, endtime, content, draftuser) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssss", $contractId, $customername, $contractname, $begintime, $endtime, $content, $name);
	$stmt->execute();
	$sql = "INSERT INTO contract_state(contractId, type) VALUES('".$contractId."', 'Draft')";
	$result = $conn->query($sql);
	echo "起草合同成功";
	$stmt->close();
}  else if ($s == "select" && $contractId != "") {
	$sql = "SELECT * FROM contract WHERE contractId = '".$contractId."'";

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
} else if ($s == "selectdraft") {
	$sql = "SELECT draftUser FROM contract WHERE contractId = '".$contractId."'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_array($result);
		session_start();
		$name = $_SESSION['name'];
		if ($row[0] == $name) {
			echo true;
		} else {
			echo false;
		}
	} else {
		echo false;
	}
} else if($s == "update") {
	$sql = "UPDATE contract SET content = '".$content."' WHERE contractId = '".$contractId."'";
	$sql1 = "UPDATE contract_state SET type = 'Finalized' WHERE contractId = '".$contractId."'";
	if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE) {
		echo "操作成功";
	} else {
		echo "操作失败";
	}
}
?>