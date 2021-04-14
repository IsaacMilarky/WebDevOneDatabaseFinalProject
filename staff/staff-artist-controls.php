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
	
	echo "<form action=\"create-artist.php\" method=\"post\">";
	echo "<label for=\"new-artist-name\">Artist Name:</label>";
	echo "<input type=\"text\" id=\"new-artist-name\" name=\"new-artist-name\">";
	echo "<label for=\"new-artist-country\">Artist Country:</label>";
	echo "<input type=\"text\" id=\"new-artist-country\" name=\"new-artist-country\">";
	echo "<label for=\"new-artist-dob\">Artist Date of Birth:</label>";
	echo "<input type=\"text\" id=\"new-artist-dob\" name=\"new-artist-dob\">";
	echo "<input type=\"submit\" value=\"Create New Artist\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM ARTIST";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-artist.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"artist-name\" name=\"artist-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-artist-name\">Artist Name:</label>";
		echo "<input type=\"text\" id=\"new-artist-name\" name=\"new-artist-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-artist-country\">Artist Country:</label>";
		echo "<input type=\"text\" id=\"new-artist-country\" name=\"new-artist-country\" value=\"", $row["Country"], "\">";
		echo "<label for=\"new-artist-dob\">Artist Date of Birth:</label>";
		echo "<input type=\"text\" id=\"new-artist-dob\" name=\"new-artist-dob\" value=\"", $row["Date_of_birth"], "\">";
		echo "<input type=\"submit\" value=\"Update Artist Information\">";
		echo "<input type=\"submit\" value=\"Delete Artist\" formaction=\"delete-artist.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
