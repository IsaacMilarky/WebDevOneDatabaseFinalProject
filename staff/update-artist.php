<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Artist update - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-artist-controls.php\">Artistt Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['artist-name']) && isset($_POST['new-artist-name']) && isset($_POST['new-artist-country']) && isset($_POST['new-artist-dob'])) {
		$old_name = $_POST['artist-name'];
		$name = $_POST['new-artist-name'];
		$country = $_POST['new-artist-country'];
		$dob = $_POST['new-artist-dob'];
		
		if(empty($old_name) || empty($name) || empty($country) || empty($dob)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE ARTIST SET Name='$name', Country='$country', Date_of_birth='$dob' WHERE Name='$old_name';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated artist.</p>";
		}
		else {
			echo "<p>Error updating artist:</p>";
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
