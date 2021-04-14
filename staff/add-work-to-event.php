<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add work to event - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-works-at-event-controls.php\">Event Critic Guest Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;
	
	if(isset($_POST['new-event']) && isset($_POST['new-work'])) {
		$event = $_POST['new-event'];
		$work = $_POST['new-work'];
		
		if(empty($event) || empty($work)) {
			echo "<h3>No event or work provided!</h3>";
			return;
		}
	
		$sql = "INSERT INTO WORKS_AT_EVENTS VALUES ('$work', '$event');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully created added new work to event.</p>";
		}
		else {
			echo "<p>Error adding work to event:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No event or work provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
