<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$customername = isset($_POST['customername']) ? htmlspecialchars($_POST['customername']) : "";
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "";
$tel1 = isset($_POST['tel1']) ? htmlspecialchars($_POST['tel1']) : "";
$tel2 = isset($_POST['tel2']) ? htmlspecialchars($_POST['tel2']) : "";
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
$bank = isset($_POST['bank']) ? htmlspecialchars($_POST['bank']) : "";
$account = isset($_POST['account']) ? htmlspecialchars($_POST['account']) : "";
$remark = isset($_POST['remark']) ? htmlspecialchars($_POST['remark']) : "";

$s = isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : "";

if ($s == "select" && $customername ==  "") {
	$sql = "SELECT * FROM `customer`";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('customername' => $row["customername"], 'address' => $row["address"], 'tel1' => $row["tel1"], 'tel2' => $row["tel2"], 'email' => $row["email"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if ($s == "select" && $customername !=  "") {
	$sql = "SELECT * FROM `customer` WHERE customername = '".$customername."'";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = array('customername' => $row["customername"],
			'address' => $row["address"], 'tel1' => $row["tel1"], 
			'tel2' => $row["tel2"], 'email' => $row["email"], 
			'bank' => $row["bank"], 'account' => $row["account"], 'remark' => $row["remark"]);
		}
	}
	$json=json_encode($data);
	echo $json;
} else if($s == "insert") {
	
	if ($address == "") {
		echo "请输入地址！";
	} else if ($tel1 == "" && tel2 == "") {
		echo "请至少输入一个联系方式";
	} else {
		require_once 'formcheck.php';
		$err = validCusName($customername);
		if ($err == "") {
			$err = validEmail($email);
		}
		if ($err == "") {
			$stmt = $conn->prepare("INSERT INTO customer (customername, address, tel1, tel2, email, bank, account, remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			if ($tel1 == "" && $tel2 != "") {
				$stmt->bind_param("ssssssss", $customername, $address, $tel2, null, $email, $bank, $account, $remark);
			} else if ($tel1 != "" && $tel2 == "") {
				$stmt->bind_param("ssssssss", $customername, $address, $tel1, null, $email, $bank, $account, $remark);
			} else if ($tel1 != "" && $tel2 != "") {
				$stmt->bind_param("ssssssss", $customername, $address, $tel1, $tel2, $email, $bank, $account, $remark);
			}
			$stmt->execute();
			echo "添加客户成功";
			$stmt->close();
		}else {
			echo $err;
		}
	}
}

?>