<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
if($s == "selectinfo") {
	$sql = "SELECT c.contractId, contractname, drafttime, type,
	EXISTS(SELECT contractId FROM contract_process p WHERE p.contractId = c.contractId) AS asign
	 FROM contract c,contract_state s WHERE c.contractId = s.contractId";

	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('contractId' => $row["contractId"], 'contractname' => $row["contractname"],
			'drafttime' => $row["drafttime"], 'type' => $row["type"], 'asign' => $row["asign"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if($s == "select" && $type != "") {
	$sql = "SELECT c.contractId, contractname, drafttime
	 FROM contract c,contract_state s WHERE c.contractId = s.contractId AND type = '".$type."'";

	if ($type == 'Approve') {
		$sql = "SELECT c.contractId, contractname, drafttime
	 	FROM contract c,contract_state s, contract_process p WHERE c.contractId = s.contractId AND c.contractId = p.contractId AND s.type = 'Approve' AND p.type = 'Approve' AND p.state > 'Rejected'";
	}
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('contractId' => $row["contractId"], 'contractname' => $row["contractname"], 'drafttime' => $row["drafttime"]);
		}
	}
	$json=json_encode($data);
	echo $json;
}

?>