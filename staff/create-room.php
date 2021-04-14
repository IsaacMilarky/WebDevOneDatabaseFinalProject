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
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-room-controls.php\">Room Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-room-theme']) && isset($_POST['new-room-loc'])) {
		$theme = $_POST['new-room-theme'];
		$loc = $_POST['new-room-loc'];
		
		if(empty($theme) || empty($loc)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
	
		$sql = "INSERT INTO ROOM VALUES ('$theme', '$loc');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new room.</p>";
		}
		else {
			echo "<p>Error creating room:</p>";
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
