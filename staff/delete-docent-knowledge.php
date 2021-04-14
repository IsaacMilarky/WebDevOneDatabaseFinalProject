<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Remove Docent Knowledge - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_docent_logged_in() || is_manager_logged_in()) {
		echo "<p><a href=\"staff-educates-about-controls.php\">Educates About Controls</a></p>";
		delete_event();
	} else {
		echo "<h1>You are not logged in as a docent or manager member!</h1>";
	}
}

function delete_event() {
	global $db_connection;

	if(isset($_POST['docent']) && isset($_POST['work'])) {
		$docent = $_POST['docent'];
		$work = $_POST['work'];
	
		$sql = "DELETE FROM EDUCATES_ABOUT WHERE SSN='$docent' AND Catalog_id='$work';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully removed docent knowledge.</p>";
		}
		else {
			echo "<p>Error deleting docent knowledge:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No information to delete provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
