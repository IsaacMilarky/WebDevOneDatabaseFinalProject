<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Guest Updating - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-guest-controls.php\">Event Guest Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-event']) && isset($_POST['new-guest']) && isset($_POST['event']) && isset($_POST['guest'])) {
		$new_event = $_POST['new-event'];
		$new_guest = $_POST['new-guest'];
		$event = $_POST['event'];
		$guest = $_POST['guest'];
		
		if(empty($new_event) || empty($new_guest) || empty($event) || empty($guest)) {
			echo "<h3>Missing guest information!</h3>";
			return;
		}
	
		$sql = "UPDATE TYPICAL_GUESTS SET Event_time='$new_event', cid='$new_guest' WHERE Event_time='$event' and cid='$guest';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated guest.</p>";
		}
		else {
			echo "<p>Error updating guest:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Missing guest information!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
