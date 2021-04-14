<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff critic guest controls - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		show_staff_controls();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function show_staff_controls() {
	/* using these pages as refernece for file upload:
	https://www.w3schools.com/php/php_file_upload.asp
	https://www.php.net/manual/en/features.file-upload.post-method.php
	*/
	
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	
	echo "<form action=\"add-critic-guest.php\" method=\"post\">";
	echo "</br><label for=\"new-event\">Event:</label>";
	echo "<select id=\"new-event\" name=\"new-event\">";
	$sql = "SELECT * FROM EVENTS";
	$events = $db_connection->query($sql);
	foreach($events as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["Timestamp"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<label for=\"new-guest\">Critic Guest Name:</label>";
	echo "<select id=\"new-guest\" name=\"new-guest\">";
	$sql = "SELECT * FROM CRITIC";
	$critics = $db_connection->query($sql);
	foreach($critics as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["cid"], "\">", $row["Name"], "</option>";
	}
	echo "</select>";
	echo "<input type=\"submit\" value=\"Add Critic Guest to Event\">";
	echo "</th></tr></table>";
	echo "</form></br>";
	
	
	$sql = "SELECT * FROM CRITIC_GUESTS";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$guest = $row["cid"];
		$event = $row["Event_time"];
		
		echo "<form action=\"update-critic-guest.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"event\" name=\"event\" value=\"$event\">";
		echo "<input type=\"hidden\" id=\"guest\" name=\"guest\" value=\"$guest\">";
		echo "<label for=\"new-event\">Event:</label>";
		echo "<select id=\"new-event\" name=\"new-event\">";
		$sql = "SELECT * FROM EVENTS";
		$events = $db_connection->query($sql);
		foreach($events as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["Timestamp"], "\"";
			if($row["Timestamp"] == $event) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "<label for=\"new-guest\">Critic Guest Name:</label>";
		echo "<select id=\"new-guest\" name=\"new-guest\">";
		$sql = "SELECT * FROM CRITIC";
		$critics = $db_connection->query($sql);
		foreach($critics as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["cid"], "\""; 
			if($row["cid"] == $guest) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "<input type=\"submit\" value=\"Update Critic Guest Event Information\">";
		echo "<input type=\"submit\" value=\"Delete Critic Guest from Event\" formaction=\"delete-critic-guest.php\">";
		echo "</th></tr></table>";
		echo "</form>\n";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
