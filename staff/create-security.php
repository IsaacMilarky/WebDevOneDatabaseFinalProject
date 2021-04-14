<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Creating security guard - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"security-controls.php\">Security Controls</a></p>";
		create_employee();
	} else {
		echo "<h1>You are not logged in as a manager member!</h1>";
	}
}

function create_employee() {
	global $db_connection;

	if(isset($_POST['new-security-id']) && isset($_POST['new-security-clearance'])) {
		$id = $_POST['new-security-id'];
		$clearance = $_POST['new-security-clearance'];
		
		
		if(empty($id) || empty($clearance)) {
			echo "<h3>Form not filled out!</h3>";
			echo "$id , $clearance";
			return;
		}
			
		$sql = "INSERT INTO SECURITY VALUES ('$id', '$clearance');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new security guard.</p>";
		}
		else {
			echo "<p>Error creating security guard:</p>";
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
