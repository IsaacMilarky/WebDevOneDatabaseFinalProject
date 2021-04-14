<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Login Processing - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-event-name']) && isset($_POST['new-event-time']) && isset($_POST['event-timestamp'])) {
		$name = $_POST['new-event-name'];
		$time = $_POST['new-event-time'];
		$timestamp = $_POST['event-timestamp'];
		
		if(empty($name) || empty($time) || empty($timestamp)) {
			echo "<h3>No event time and/or name provided!</h3>";
			return;
		}
	
		$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated event.</p>";
		}
		else {
			echo "<p>Error updating event:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No event time and/or name provided!</h3>";
	}
}

check_login();
?>
<?php include 'ref-links.php';?>
</body>
</html>
