<?php
/**
 * Enter description here ...
 * @author Jensen
 *
 */
class Role {
	private $strRoleName;
	private $strDescription;
	private $strFunction;
	
	function __construct($roleName, $descrition) {
		$this->strRoleName = $roleName;
		$this->strDescription = $descrition;
		$this->strFunction = "";
	}
	
	function __destruct() {}
	
	function setRoleName($roleName) {
		$this->strRoleName = $roleName;
	}
	
	function setDescription($description) {
		$this->strDescription = $description;
	}
	
	function setFunction($function) {
		$this->strFunction = $function;
	}
	
	function getRoleName() {
		return $this->strRoleName;
	}
	
	function getDescription() {
		return $this->strDescription;
	}
	
	function getFunction() {
		return $this->strFunction;
	}
}
?>