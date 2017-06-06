<?php
/**
 * Enter description here ...
 * @author Jensen
 *
 */
class User {
	private $strUserName;
	private $strName;
	private $strPassword;
	
	function __construct($userName, $password) {
		$this->strUserName = $userName;
		$this->strPassword = $password;
		$this->strName = "";
		$this->bDel = 0;
	}
	
	function __destruct() {}
	
	function setUsername($userName) {
		$this->strUserName = $userName;
	}
	
	function setPassword($password) {
		$this->strPassword = $password;
	}
	
	function setName($name) {
		$this->strName = $name;
	}
	
	function getUserName() {
		return $this->strUserName;
	}
	
	function getPassword() {
		return $this->strPassword;
	}
	
	function getName() {
		return $this->strName;
	}
}
?>