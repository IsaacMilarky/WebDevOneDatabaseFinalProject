<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manager controls - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		show_employee_controls();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function show_employee_controls() {
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	
	echo "<form action=\"create-manager.php\" method=\"post\">";
	echo "<label for=\"new-manager\">Manager id:</label>";
	echo "<select id=\"new-manager\" name=\"new-manager\">";
	$sql = "SELECT * FROM EMPLOYEE";
	$employees = $db_connection->query($sql);
	foreach($employees as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["SSN"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<input type=\"submit\" value=\"Create New Manager\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM MANAGER INNER JOIN EMPLOYEE ON MANAGER.SSN = EMPLOYEE.SSN";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form method=\"post\">";
		echo "<input type=\"hidden\" id=\"manager-id\" name=\"manager-id\" value=\"", $row["SSN"], "\">";
		echo "Manager ID: ", $row["SSN"], " Manager Name: ", $row["Name"];
		echo "<input type=\"submit\" value=\"Delete Manager\" formaction=\"delete-manager.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
