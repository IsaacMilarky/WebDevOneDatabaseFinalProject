<?php

function is_staff_logged_in() {
	global $db_connection;

	if(isset($_SESSION['staff-id']) && isset($_SESSION['staff-password'])) {
		$id = $_SESSION['staff-id'];
		$password = $_SESSION['staff-password'];
	
		$sql = "SELECT * FROM EMPLOYEE WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$stored_password = $row["Password"];
			
			if($password == $stored_password) {
				return true;
			}
		}
	}
	
	return false;
}

function is_customer_logged_in() {
	global $db_connection;

	if(isset($_SESSION['customer-id']) && isset($_SESSION['customer-password'])) {
		$id = $_SESSION['customer-id'];
		$password = $_SESSION['customer-password'];
	
		$sql = "SELECT * FROM CUSTOMER WHERE cid='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$stored_password = $row["Password"];
			
			if($password == $stored_password) {
				return true;
			}
		}
	}
	
	return false;
}

function is_docent_logged_in() {
	global $db_connection;

	if(is_staff_logged_in()) {
		$id = $_SESSION['staff-id'];
	
		$sql = "SELECT * FROM DOCENT WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			return true;
		}
	}
	
	return false;
}

function is_manager_logged_in() {
	global $db_connection;

	if(is_staff_logged_in()) {
		$id = $_SESSION['staff-id'];
	
		$sql = "SELECT * FROM MANAGER WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			return true;
		}
	}
	
	return false;
}

function is_security_logged_in() {
	global $db_connection;

	if(is_staff_logged_in()) {
		$id = $_SESSION['security-id'];
	
		$sql = "SELECT * FROM SECURITY WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			return true;
		}
	}
	
	return false;
}

?>
