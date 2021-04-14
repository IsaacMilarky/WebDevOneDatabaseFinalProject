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
	if(is_manager_logged_in()) {
		echo "<p><a href=\"employee-controls.php\">Employee Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['employee-id']) && isset($_POST['new-employee-id']) && isset($_POST['new-employee-name']) && isset($_POST['new-employee-wage']) && isset($_POST['new-employee-schedule']) && isset($_POST['new-employee-password'])) {
		$old_id = $_POST['employee-id'];
		$id = $_POST['new-employee-id'];
		$name = $_POST['new-employee-name'];
		$wage = $_POST['new-employee-wage'];
		$schedule = $_POST['new-employee-schedule'];
		$password = $_POST['new-employee-password'];
		
		if(empty($old_id) || empty($id) || empty($name) || empty($wage) || empty($schedule)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE EMPLOYEE SET SSN='$id', Name='$name', Hourly_wage='$wage', Schedule='$schedule'";
		
		if(empty($password) == False) {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql .= ", Password='$hash'";
		}
		
		$sql .= " WHERE SSN='$old_id';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated employee.</p>";
		}
		else {
			echo "<p>Error updating employee:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No employee information provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
