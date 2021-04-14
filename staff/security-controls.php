<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Security controls - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_manager_logged_in()) {
		show_security_controls();
	} else {
		echo "<h1>You are not logged in as a manager!</h1>";
	}
}

function show_security_controls() {
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	
	echo "<form action=\"create-security.php\" method=\"post\">";
	echo "<label for=\"new-security-id\">Security id:</label>";
	echo "<select id=\"new-security-id\" name=\"new-security-id\">";
	$sql = "SELECT * FROM EMPLOYEE";
	$employees = $db_connection->query($sql);
	foreach($employees as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["SSN"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<label for=\"new-security-clearance\">Security Badge Clearance:</label>";
	echo "<input type=\"text\" id=\"new-security-clearance\" name=\"new-security-clearance\">";
	echo "<input type=\"submit\" value=\"Create New Security Guard\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM SECURITY";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$id = $row['SSN'];
		$badge = $row['Badge_Clearance'];
		echo "<form action=\"update-security.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"security-id\" name=\"security-id\" value=\"", $row["SSN"], "\">";
		echo "<label for=\"new-security-id\">Security id:</label>";
		echo "<select id=\"new-security-id\" name=\"new-security-id\">";
		$sql = "SELECT * FROM EMPLOYEE";
		$employees = $db_connection->query($sql);
		foreach($employees as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["SSN"], "\"";
			if($id == $row['SSN']) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "<label for=\"new-security-clearance\">Security Badge Clearance:</label>";
		echo "<input type=\"text\" id=\"new-security-clearance\" name=\"new-security-clearance\" value=\"", $badge, "\">";
		echo "<input type=\"submit\" value=\"Update Security Guard Information\">";
		echo "<input type=\"submit\" value=\"Delete Security Guard\" formaction=\"delete-security.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
