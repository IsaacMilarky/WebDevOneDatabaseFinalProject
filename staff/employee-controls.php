<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff event controls - FinalProject</title>
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
	
	echo "<form action=\"create-employee.php\" method=\"post\">";
	echo "<label for=\"new-employee-id\">Employee id:</label>";
	echo "<input type=\"text\" id=\"new-employee-id\" name=\"new-employee-id\">";
	echo "<label for=\"new-employee-name\">Employee name:</label>";
	echo "<input type=\"text\" id=\"new-employee-name\" name=\"new-employee-name\">";
	echo "<label for=\"new-employee-wage\">Employee wage:</label>";
	echo "<input type=\"text\" id=\"new-employee-wage\" name=\"new-employee-wage\">";
	echo "<label for=\"new-employee-schedule\">Employee Schedule:</label>";
	echo "<input type=\"text\" id=\"new-employee-schedule\" name=\"new-employee-schedule\">";
	echo "<label for=\"new-employee-password\">Employee password:</label>";
	echo "<input type=\"text\" id=\"new-employee-password\" name=\"new-employee-password\">";
	echo "<input type=\"submit\" value=\"Create New Employee\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM EMPLOYEE";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-employee.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"employee-id\" name=\"employee-id\" value=\"", $row["SSN"], "\">";
		echo "<label for=\"new-employee-id\">Employee id:</label>";
		echo "<input type=\"text\" id=\"new-employee-id\" name=\"new-employee-id\" value=\"", $row["SSN"], "\">";
		echo "<label for=\"new-employee-name\">Employee name:</label>";
		echo "<input type=\"text\" id=\"new-employee-name\" name=\"new-employee-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-employee-wage\">Employee wage:</label>";
		echo "<input type=\"text\" id=\"new-employee-wage\" name=\"new-employee-wage\" value=\"", $row["Hourly_wage"], "\">";
		echo "<label for=\"new-employee-schedule\">Employee Schedule:</label>";
		echo "<input type=\"text\" id=\"new-employee-schedule\" name=\"new-employee-schedule\" value=\"", $row["Schedule"], "\">";
		echo "<label for=\"new-employee-password\">Employee password:</label>";
		echo "<input type=\"text\" id=\"new-employee-password\" name=\"new-employee-password\">";
		echo "<input type=\"submit\" value=\"Update Employee Information\">";
		echo "<input type=\"submit\" value=\"Delete Employee\" formaction=\"delete-employee.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
