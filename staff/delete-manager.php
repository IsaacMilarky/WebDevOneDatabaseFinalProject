<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manager Deletion Processing - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"manager-controls.php\">Manager Controls</a></p>";
		delete_employee();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function delete_employee() {
	global $db_connection;

	if(isset($_POST['manager-id'])) {
		$id = $_POST['manager-id'];
	
		$sql = "DELETE FROM MANAGER WHERE SSN='$id'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully deleted manager.</p>";
		}
		else {
			echo "<p>Error deleting manager:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No manager provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
