<?php
class Right {
	private $rightid;
	private $username;
	private $rolename;
	private $description;

	function __construct($username, $rolename) {
		$this->username = $username;
		$this->rolename = $rolename;
	}
	
	function __destruct() {}

	function setRightId() { 
		require_once 'db/MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

		if ($conn->connect_error) {
			die("Α¬½ΣΚ§°ά: " . $conn->connect_error);
		}else {
			$this->strCustomerId = $this->rolename.getRightId($conn);
		}
	} 
	
	function getUserName() {
		return $this->username;
	}
	
	function getRoleName() {
		return $this->rolename;
	}
	
	function getDescription() {
		return $this->description;
	}
	
	function setDescription($description) {
		$this->description = $description;
	}

}
?>