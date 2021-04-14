<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Critic Guest to event - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-critic-guest-controls.php\">Event Critic Guest Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;
	
	if(isset($_POST['new-event']) && isset($_POST['new-guest'])) {
		$event = $_POST['new-event'];
		$guest = $_POST['new-guest'];
		
		if(empty($event) || empty($guest)) {
			echo "<h3>No event or guest provided!</h3>";
			return;
		}
	
		$sql = "INSERT INTO CRITIC_GUESTS VALUES ('$guest', '$event');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully created added new Critic guest to event.</p>";
		}
		else {
			echo "<p>Error adding Critic guest:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No event or guest provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
