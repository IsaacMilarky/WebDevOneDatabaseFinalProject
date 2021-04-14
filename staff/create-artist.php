<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Artist - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-artist-controls.php\">Artist Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-artist-name']) && isset($_POST['new-artist-country']) && isset($_POST['new-artist-dob'])) {
		$name = $_POST['new-artist-name'];
		$country = $_POST['new-artist-country'];
		$dob = $_POST['new-artist-dob'];
		
		if(empty($name) || empty($country) || empty($dob)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
	
		$sql = "INSERT INTO ARTIST VALUES ('$name', '$country', '$dob');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new artist.</p>";
		}
		else {
			echo "<p>Error creating artist:</p>";
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
