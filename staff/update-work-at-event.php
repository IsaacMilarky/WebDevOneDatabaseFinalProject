<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Work at event Updating - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-works-at-event-controls.php\">Works at events Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-event']) && isset($_POST['new-work']) && isset($_POST['event']) && isset($_POST['work'])) {
		$new_event = $_POST['new-event'];
		$new_work = $_POST['new-work'];
		$event = $_POST['event'];
		$work = $_POST['work'];
		
		if(empty($new_event) || empty($new_work) || empty($event) || empty($work)) {
			echo "<h3>Missing work information!</h3>";
			return;
		}
	
		$sql = "UPDATE WORKS_AT_EVENTS SET Event_time='$new_event', Work='$new_work' WHERE Event_time='$event' and Work='$work';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully updated work at event.</p>";
		}
		else {
			echo "<p>Error updating work at event:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Missing work information!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
