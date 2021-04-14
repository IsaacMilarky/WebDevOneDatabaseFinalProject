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
		echo "<p><a href=\"security-controls.php\">Security Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['security-id']) && isset($_POST['new-security-id']) && isset($_POST['new-security-clearance'])) {
		$old_id = $_POST['security-id'];
		$id = $_POST['new-security-id'];
		$clearance = $_POST['new-security-clearance'];
		
		if(empty($old_id) || empty($id) || empty($clearance)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE SECURITY SET SSN='$id', Badge_Clearance='$clearance' WHERE SSN='$old_id';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully updated security guard.</p>";
		}
		else {
			echo "<p>Error updating security guard:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No security guard information provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
