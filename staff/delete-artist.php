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
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-artist-controls.php\">Artist Controls</a></p>";
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['artist-name'])) {
		$name = $_POST['artist-name'];
	
		$sql = "DELETE FROM ARTIST WHERE Name='$name'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully deleted artist.</p>";
		}
		else {
			echo "<p>Error deleting artist:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No artist provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
