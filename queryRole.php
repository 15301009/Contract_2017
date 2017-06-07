<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
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
?>