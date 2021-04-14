<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff critic controls - FinalProject</title>
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
	
	echo "<form action=\"create-critic.php\" method=\"post\">";
	echo "<label for=\"new-critic-cid\">Critic cid:</label>";
	echo "<input type=\"text\" id=\"new-critic-cid\" name=\"new-critic-cid\">";
	echo "<label for=\"new-critic-name\">Critic Name:</label>";
	echo "<input type=\"text\" id=\"new-critic-name\" name=\"new-critic-name\">";
	echo "<label for=\"new-critic-country\">Critic Country:</label>";
	echo "<input type=\"text\" id=\"new-critic-country\" name=\"new-critic-country\">";
	echo "<input type=\"submit\" value=\"Create New Critic\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM CRITIC";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-critic.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"critic-cid\" name=\"critic-cid\" value=\"", $row["cid"], "\">";
		echo "<label for=\"new-critic-cid\">Critic cid:</label>";
		echo "<input type=\"text\" id=\"new-critic-cid\" name=\"new-critic-cid\" value=\"", $row["cid"], "\">";
		echo "<label for=\"new-critic-name\">Critic Name:</label>";
		echo "<input type=\"text\" id=\"new-critic-name\" name=\"new-critic-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-critic-country\">Critic Country:</label>";
		echo "<input type=\"text\" id=\"new-critic-country\" name=\"new-critic-country\" value=\"", $row["Country"], "\">";
		echo "<input type=\"submit\" value=\"Update Critic Information\">";
		echo "<input type=\"submit\" value=\"Delete Critic\" formaction=\"delete-critic.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
