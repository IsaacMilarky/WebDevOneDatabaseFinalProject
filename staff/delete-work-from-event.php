<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Remove Work From Event - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-works-at-event-controls.php\">Event Works at event Controls</a></p>";
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['event']) && isset($_POST['work'])) {
		$event = $_POST['event'];
		$work = $_POST['work'];
	
		$sql = "DELETE FROM WORKS_AT_EVENTS WHERE Event_time='$event' AND Work='$work';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully removed work from event.</p>";
		}
		else {
			echo "<p>Error deleting work from event:</p>";
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
