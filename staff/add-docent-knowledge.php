<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Docent Knowledge - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_docent_logged_in() || is_manager_logged_in()) {
		echo "<p><a href=\"staff-educates-about-controls.php\">Educates About Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a docent or manager member!</h1>";
	}
}

function create_event() {
	global $db_connection;
	
	if(isset($_POST['new-docent']) && isset($_POST['new-work'])) {
		$docent = $_POST['new-docent'];
		$work = $_POST['new-work'];
		
		if(empty($docent) || empty($work)) {
			echo "<h3>No information provided!</h3>";
			return;
		}
	
		$sql = "INSERT INTO EDUCATES_ABOUT VALUES ('$work', '$docent');";
		
		$result = $db_connection->query($sql);
		//echo $sql;
		if($result) {
			echo "<p>Successfully added new docent knowledge.</p>";
		}
		else {
			echo "<p>Error adding docent knowledge:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>No information provided!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
