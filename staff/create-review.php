<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Review - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-review-controls.php\">Review Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	global $db_connection;

	if(isset($_POST['new-review-title']) && isset($_POST['new-review-author']) && isset($_POST['new-review-date']) && isset($_POST['new-review-text'])) {
		$title = $_POST['new-review-title'];
		$author = $_POST['new-review-author'];
		$date = $_POST['new-review-date'];
		$text = $_POST['new-review-text'];
		
		if(empty($title) || empty($author) || empty($date) || empty($text)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
	
		$sql = "INSERT INTO REVIEW VALUES ('$title', '$author', '$date', '$text');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new review.</p>";
		}
		else {
			echo "<p>Error creating review:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Form not filled out!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
