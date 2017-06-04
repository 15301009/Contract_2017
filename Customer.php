<?php
class Customer {
	private $strCustomerId;
	private $strCustomerName;
	private $strCompany;
	private $strAddress;
	private $strTel1;
	private $strTel2;
	private $strEmail;
	private $strAccount;

	function __construct($name, $company, $address, $tel1, $tel2, $email, $account) {
		$this->strCustomerName = $name;
		$this->strCompany = $company;
		$this->strAddress = $address;
		$this->strTel1 = $tel1;
		$this->strTel2 = $tel2;
		$this->strAccount = $account;
		$this->strEmail = $email;
	}

	function setCustomerId() {
		require_once 'MySqlConn.php';
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

		if ($conn->connect_error) {
			die("Α¬½ΣΚ§°ά: " . $conn->connect_error);
		}else {
			$this->strCustomerId = getNewCustomerId($conn);
		}
	}

	function setCustomerName($name) {
		$this->strCustomerName = $name;
	}

	function setCompany($company) {
		$this->strCompany = $company;
	}

	function setAddress($address) {
		$this->strAddress = $address;
	}

	function setTel1($tel) {
		$this->strTel1 = $tel;
	}

	function setTel2($tel) {
		$this->strTel2 = $tel;
	}

	function setEmail($email) {
		$this->strEmail = $email;
	}

	function setAccount($account) {
		$this->strAccount = $account;
	}

	function getAccount() {
		return $this->strAccount;
	}

	function getEmail() {
		return $this->strEmail;
	}

	function getTel1() {
		return $this->strTel1;
	}

	function getTel2() {
		return $this->strTel2;
	}

	function getAddress() {
		return $this->strAddress;
	}

	function getCompany() {
		return $this->strCompany;
	}

	function getCustomerName() {
		return $this->strCustomerName;
	}

	function getCustomerId() {
		return $this->strCustomerId;
	}
}

$cus = new Customer("1", "", "", "", "", "", "");

$cus->setCustomerId();

echo $cus->getCustomerId();
?>