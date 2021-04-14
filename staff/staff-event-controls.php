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
	
	echo "<form action=\"create-event.php\" method=\"post\">\n";
	echo "<label for=\"new-event-name\">Event name:</label>";
	echo "<input type=\"text\" id=\"new-event-name\" name=\"new-event-name\">";
	echo "<label for=\"new-event-time\">Event time:</label>";
	echo "<input type=\"datetime-local\" id=\"new-event-time\" name=\"new-event-time\">";
	echo "<input type=\"submit\" value=\"Create New Event\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM EVENTS";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$time = $row["Timestamp"];
		$date = new DateTime("$time");
		//$date->setTimeZone(new DateTimeZone('CST'));
		echo "<form action=\"update-event.php\" method=\"post\">\n";
		echo "<input type=\"hidden\" id=\"event-timestamp\" name=\"event-timestamp\" value=\"$time\">";
		echo "<label for=\"new-event-name\">Event name:</label>";
		echo "<input type=\"text\" id=\"new-event-name\" name=\"new-event-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-event-time\">Event time:</label>";
		echo "<input type=\"datetime-local\" id=\"new-event-time\" name=\"new-event-time\" value=\"", $date->format("Y-m-d\TH:i:s"), "\">";
		echo "<input type=\"submit\" value=\"Update Event\">";
		echo "<input type=\"submit\" value=\"Delete Event\" formaction=\"delete-event.php\">";
		echo "</form>\n";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
