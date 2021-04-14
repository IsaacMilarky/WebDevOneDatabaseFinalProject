<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Login Processing - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"docent-controls.php\">Docent Controls</a></p>";
		create_docent();
	} else {
		echo "<h1>You are not logged in as a manager member!</h1>";
	}
}

function create_docent() {
	global $db_connection;

	if(isset($_POST['new-docent-id']) && isset($_POST['new-docent-area']) && isset($_POST['new-docent-edu-level'])) {
		$id = $_POST['new-docent-id'];
		$area = $_POST['new-docent-area'];
		$edu_level = $_POST['new-docent-edu-level'];
		
		if(empty($id) || empty($area) || empty($edu_level)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
		
		$sql = "INSERT INTO DOCENT (SSN, Area_Of_Expertise, Level_Of_Education) VALUES ('$id', '$area', '$edu_level');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new docent.</p>";
		}
		else {
			echo "<p>Error creating docent:</p>";
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
