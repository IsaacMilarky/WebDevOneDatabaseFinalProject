<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Remove Critic From Event - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-critic-guest-controls.php\">Event Critic Guest Controls</a></p>";
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['event']) && isset($_POST['event'])) {
		$event = $_POST['event'];
		$guest = $_POST['guest'];
	
		$sql = "DELETE FROM CRITIC_GUESTS WHERE Event_time='$event' AND cid='$guest';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully removed critic guest from event.</p>";
		}
		else {
			echo "<p>Error deleting critic guest:</p>";
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
