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
		echo "<p><a href=\"docent-controls.php\">Employee Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['docent-id']) && isset($_POST['new-docent-id']) && isset($_POST['new-docent-area']) && isset($_POST['new-docent-edu-level'])) {
		$old_id = $_POST['docent-id'];
		$id = $_POST['new-docent-id'];
		$area = $_POST['new-docent-area'];
		$edu_level = $_POST['new-docent-edu-level'];
		
		if(empty($old_id) || empty($id) || empty($area) || empty($edu_level)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE DOCENT SET SSN='$id', Area_Of_Expertise='$area', Level_Of_Education='$edu_level' WHERE SSN='$old_id';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated docent.</p>";
		}
		else {
			echo "<p>Error updating docent:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No docent information provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
