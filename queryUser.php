<?php
header("Content-Type:text/html;charset=gbk");
require 'db/MySqlConn.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
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
?>