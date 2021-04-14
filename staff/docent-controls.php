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
	
	echo "<form action=\"create-docent.php\" method=\"post\">";
	echo "<label for=\"new-docent-id\">Docent id:</label>";
	echo "<select id=\"new-docent-id\" name=\"new-docent-id\">";
	$sql = "SELECT * FROM EMPLOYEE";
	$employees = $db_connection->query($sql);
	foreach($employees as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["SSN"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<label for=\"new-docent-area\">Docent Area of Expertise:</label>";
	echo "<input type=\"text\" id=\"new-docent-area\" name=\"new-docent-area\">";
	echo "<label for=\"new-docent-edu-level\">Docent Level of Education:</label>";
	echo "<input type=\"text\" id=\"new-docent-edu-level\" name=\"new-docent-edu-level\">";
	echo "<input type=\"submit\" value=\"Create New Docent\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM DOCENT";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-docent.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"docent-id\" name=\"docent-id\" value=\"", $row["SSN"], "\">";
		echo "<label for=\"new-docent-id\">Docent id:</label>";
		echo "<select id=\"new-docent-id\" name=\"new-docent-id\">";
		$sql = "SELECT * FROM EMPLOYEE";
		$employees = $db_connection->query($sql);
		foreach($employees as $erow) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $erow["SSN"], "\"";
			if($row["SSN"] == $erow['SSN']) {
				echo " selected";
			}
			echo ">", $erow["Name"], "</option>";
		}
		echo "</select>";
		echo "<label for=\"new-docent-area\">Docent Area of Expertise:</label>";
		echo "<input type=\"text\" id=\"new-docent-area\" name=\"new-docent-area\" value=\"", $row["Area_Of_Expertise"], "\">";
		echo "<label for=\"new-docent-edu-level\">Docent Level of Education:</label>";
		echo "<input type=\"text\" id=\"new-docent-edu-level\" name=\"new-docent-edu-level\" value=\"", $row["Level_Of_Education"], "\">";
		echo "Docent Level of Expertise:", $row["Level_Of_Expertise"];
		echo "<input type=\"submit\" value=\"Update Docent Information\">";
		echo "<input type=\"submit\" value=\"Delete Docent\" formaction=\"delete-docent.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
