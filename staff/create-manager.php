<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Manager - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		echo "<p><a href=\"manager-controls.php\">Manager Controls</a></p>";
		create_employee();
	} else {
		echo "<h1>You are not logged in as a manager member!</h1>";
	}
}

function create_employee() {
	global $db_connection;

	if(isset($_POST['new-manager'])) {
		$id = $_POST['new-manager'];
		
		if(empty($id)) {
			echo "<h3>Form not filled out!</h3>";
			return;
		}
			
		$sql = "INSERT INTO MANAGER VALUES ('$id');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully created new manager.</p>";
		}
		else {
			echo "<p>Error creating manager:</p>";
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
