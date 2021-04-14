<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Docent Knowledge Updating - FinalProject</title>
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

	if(isset($_POST['new-docent']) && isset($_POST['new-work']) && isset($_POST['docent']) && isset($_POST['work'])) {
		$new_docent = $_POST['new-docent'];
		$new_work = $_POST['new-work'];
		$docent = $_POST['docent'];
		$work = $_POST['work'];
		
		if(empty($new_docent) || empty($new_work) || empty($docent) || empty($work)) {
			echo "<h3>Missing docent information!</h3>";
			return;
		}
	
		$sql = "UPDATE EDUCATES_ABOUT SET SSN='$new_docent', Catalog_id='$new_work' WHERE SSN='$docent' and Catalog_id='$work';";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Successfully docent knowledge.</p>";
		}
		else {
			echo "<p>Error updating docent knowledge:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Missing docent information!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
