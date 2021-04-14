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
	if(is_staff_logged_in()) {
		show_staff_controls();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function show_staff_controls() {
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	
	echo "<form action=\"create-room.php\" method=\"post\">";
	echo "<label for=\"new-room-loc\">Room Location:</label>";
	echo "<input type=\"text\" id=\"new-room-loc\" name=\"new-room-loc\">";
	echo "<label for=\"new-room-theme\">Room theme:</label>";
	echo "<input type=\"text\" id=\"new-room-theme\" name=\"new-room-theme\">";
	echo "<input type=\"submit\" value=\"Create New Room\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM ROOM";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-room.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"room-loc\" name=\"room-loc\" value=\"", $row["Location"], "\">";
		echo "<label for=\"new-room-loc\">Room loc:</label>";
		echo "<input type=\"text\" id=\"new-room-loc\" name=\"new-room-loc\" value=\"", $row["Location"], "\">";
		echo "<label for=\"new-room-theme\">Room Theme:</label>";
		echo "<input type=\"text\" id=\"new-room-theme\" name=\"new-room-theme\" value=\"", $row["Theme"], "\">";
		echo "<input type=\"submit\" value=\"Update Room Information\">";
		echo "<input type=\"submit\" value=\"Delete Room\" formaction=\"delete-room.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
