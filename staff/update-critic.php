<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Critic update - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-critic-controls.php\">Critic Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['critic-cid']) && isset($_POST['new-critic-cid']) && isset($_POST['new-critic-name']) && isset($_POST['new-critic-country'])) {
		$old_cid = $_POST['critic-cid'];
		$name = $_POST['new-critic-name'];
		$country = $_POST['new-critic-country'];
		$cid = $_POST['new-critic-cid'];
		
		if(empty($old_cid) || empty($name) || empty($country) || empty($cid)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE CRITIC SET Name='$name', Country='$country', cid='$cid' WHERE cid='$old_cid';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated critic.</p>";
		}
		else {
			echo "<p>Error updating critic:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No critic provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
