<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Update Processing - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['customer-id']) && isset($_POST['new-customer-id']) && isset($_POST['new-customer-name']) && isset($_POST['new-customer-email']) && isset($_POST['new-customer-password'])) {
		$old_id = $_POST['customer-id'];
		$id = $_POST['new-customer-id'];
		$name = $_POST['new-customer-name'];
		$email = $_POST['new-customer-email'];
		$password = $_POST['new-customer-password'];
		
		if(empty($old_id) || empty($id) || empty($name) || empty($email)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE CUSTOMER SET cid='$id', Name='$name', Email='$email'";
		
		if(empty($password) == False) {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql .= ", Password='$hash'";
		}
		
		$sql .= " WHERE cid='$id';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated customer.</p>";
		}
		else {
			echo "<p>Error updating customer:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No customer time and/or name provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
