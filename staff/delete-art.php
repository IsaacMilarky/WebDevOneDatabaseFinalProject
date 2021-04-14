<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete Art - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";

	if(isset($_POST['art-id'])) {
		$id = $_POST['art-id'];
	
		$sql = "DELETE FROM WORK WHERE Catalog_id='$id'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully deleted art.</p>";
		}
		else {
			echo "<p>Error deleting art:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No art provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
