<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Review Deletion - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-review-controls.php\">Reveiw Controls</a></p>";
		delete_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['review-title']) && isset($_POST['review-author'])) {
		$title = $_POST['review-title'];
		$author = $_POST['review-author'];
	
		$sql = "DELETE FROM REVIEW WHERE Title='$title' AND Author='$author'";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully deleted review.</p>";
		}
		else {
			echo "<p>Error deleting review:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No review provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
