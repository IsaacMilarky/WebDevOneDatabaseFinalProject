<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Login Processing - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"employee-controls.php\">Employee Controls</a></p>";
		create_employee();
	} else {
		echo "<h1>You are not logged in as a manager member!</h1>";
	}
}

function create_employee() {
	global $db_connection;

	if(isset($_POST['new-employee-id']) && isset($_POST['new-employee-name']) && isset($_POST['new-employee-wage']) && isset($_POST['new-employee-schedule']) && isset($_POST['new-employee-password'])) {
		$id = $_POST['new-employee-id'];
		$name = $_POST['new-employee-name'];
		$wage = $_POST['new-employee-wage'];
		$schedule = $_POST['new-employee-schedule'];
		$password = $_POST['new-employee-password'];
		
		if(empty($id) || empty($name) || empty($wage) || empty($schedule) || empty($password)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$hash = password_hash($password, PASSWORD_DEFAULT);
	
		$sql = "INSERT INTO EMPLOYEE VALUES ('$id', '$name', '$wage', '$schedule', '$hash');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new employee.</p>";
		}
		else {
			echo "<p>Error creating employee:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Form not filled out!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
