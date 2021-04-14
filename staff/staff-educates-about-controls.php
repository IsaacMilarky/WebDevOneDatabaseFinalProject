<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Educates About controls - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_docent_logged_in() || is_manager_logged_in()) {
		show_staff_controls();
	} else {
		echo "<h1>You are not logged in as a docent or manager member!</h1>";
	}
}

function show_staff_controls() {
	/* using these pages as refernece for file upload:
	https://www.w3schools.com/php/php_file_upload.asp
	https://www.php.net/manual/en/features.file-upload.post-method.php
	*/
	
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	
	echo "<form action=\"add-docent-knowledge.php\" method=\"post\">";
	echo "</br><label for=\"new-work\">Work:</label>";
	echo "<select id=\"new-work\" name=\"new-work\">";
	$sql = "SELECT * FROM WORK";
	$works = $db_connection->query($sql);
	foreach($works as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["Catalog_id"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<label for=\"new-docent\">Docent Name:</label>";
	echo "<select id=\"new-docent\" name=\"new-docent\">";
	$sql = "SELECT * FROM DOCENT INNER JOIN EMPLOYEE ON DOCENT.SSN = EMPLOYEE.SSN";
	$docents = $db_connection->query($sql);
	foreach($docents as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["SSN"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<input type=\"submit\" value=\"Add Docent Knowledge\">";
	echo "</form></br>";
	
	
	$sql = "SELECT * FROM EDUCATES_ABOUT";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$docent = $row["SSN"];
		$work = $row["Catalog_id"];
		
		echo "<form action=\"update-docent-knowledge.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"docent\" name=\"docent\" value=\"$docent\">";
		echo "<input type=\"hidden\" id=\"work\" name=\"work\" value=\"$work\">";
		echo "<label for=\"new-work\">Work:</label>";
		echo "<select id=\"new-work\" name=\"new-work\">";
		$sql = "SELECT * FROM WORK";
		$works = $db_connection->query($sql);
		foreach($works as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["Catalog_id"], "\"";
			if($row["Catalog_id"] == $work) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "<label for=\"new-docent\">Docent Name:</label>";
		echo "<select id=\"new-docent\" name=\"new-docent\">";
		$sql = "SELECT * FROM DOCENT INNER JOIN EMPLOYEE ON DOCENT.SSN = EMPLOYEE.SSN";
		$docents = $db_connection->query($sql);
		foreach($docents as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["SSN"], "\""; 
			if($row["SSN"] == $docent) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "<input type=\"submit\" value=\"Update Docent Knowledge\">";
		echo "<input type=\"submit\" value=\"Remove Docent Knowledge\" formaction=\"delete-docent-knowledge.php\">";
		echo "</form>\n";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
