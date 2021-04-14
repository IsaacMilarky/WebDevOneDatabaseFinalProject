<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Review update - FinalProject</title>
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

	if(isset($_POST['review-title']) && isset($_POST['review-author']) && isset($_POST['new-review-title']) && isset($_POST['new-review-author']) && isset($_POST['new-review-date']) && isset($_POST['new-review-text'])) {
		$old_title = $_POST['review-title'];
		$old_author = $_POST['review-author'];
		$title = $_POST['new-review-title'];
		$author = $_POST['new-review-author'];
		$date = $_POST['new-review-date'];
		$text = $_POST['new-review-text'];
		
		if(empty($title) || empty($author) || empty($date) || empty($text)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "UPDATE REVIEW SET Title='$title', Author='$author', Date_published='$date', Body_text='$text' WHERE Title='$old_title' AND Author='$old_author';";
	
		//$sql = "UPDATE EVENTS SET Name='$name', Timestamp='$time' WHERE Timestamp='$timestamp';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated review.</p>";
		}
		else {
			echo "<p>Error updating review:</p>";
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
