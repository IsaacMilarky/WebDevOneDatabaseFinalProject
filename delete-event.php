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
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['event-timestamp'])) {
		$timestamp = $_POST['event-timestamp'];
	
		$sql = "DELETE FROM EVENTS WHERE Timestamp='$timestamp'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully deleted event.</p>";
		}
		else {
			echo "<p>Error deleting event:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No event provided!</h3>";
	}
}

check_login();
?>
<?php include 'ref-links.php';?>
</body>
</html>
