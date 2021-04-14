<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Deletion Processing - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"docent-controls.php\">Docent Controls</a></p>";
		delete_docent();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function delete_docent() {
	global $db_connection;

	if(isset($_POST['docent-id'])) {
		$id = $_POST['docent-id'];
	
		$sql = "DELETE FROM DOCENT WHERE SSN='$id'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully deleted docent.</p>";
		}
		else {
			echo "<p>Error deleting docent:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No docent provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
