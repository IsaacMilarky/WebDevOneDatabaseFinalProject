<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff controls - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
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
	
	$id = $_SESSION['staff-id'];
	$sql = "SELECT * FROM EMPLOYEE WHERE SSN='$id'";
	$result = $db_connection->query($sql);
	$row = $result->fetch_assoc();
	
	$name = $row["Name"];
	echo "<p>Welcome $name. Would you like to logout? <a href=\"staff-logout.php\">Logout</a></p>";
	echo "<p>Your Schedule is: ", $row["Schedule"], "</p>";
	echo "<p><a href=\"staff/staff-event-controls.php\">Event Controls</a></p>";
	echo "<p><a href=\"staff/staff-art-controls.php\">Art Controls</a></p>";
	echo "<p><a href=\"staff/staff-customer-controls.php\">Customer Controls</a></p>";
	echo "<p><a href=\"staff/staff-guest-controls.php\">Event Guest Controls</a></p>";
	echo "<p><a href=\"staff/staff-artist-guest-controls.php\">Event Artist Guest Controls</a></p>";
	echo "<p><a href=\"staff/staff-critic-guest-controls.php\">Event Critic Guest Controls</a></p>";
	echo "<p><a href=\"staff/staff-works-at-event-controls.php\">Event Works at Events Controls</a></p>";
	echo "<p><a href=\"staff/staff-room-controls.php\">Room Controls</a></p>";
	echo "<p><a href=\"staff/staff-artist-controls.php\">Artist Controls</a></p>";
	echo "<p><a href=\"staff/staff-critic-controls.php\">Critic Controls</a></p>";
	echo "<p><a href=\"staff/staff-review-controls.php\">Review Controls</a></p>";
	
	if(is_docent_logged_in()) {
		echo "<h3>Docent Controls</h3>";
		echo "<p><a href=\"staff/staff-educates-about-controls.php\">Educates About Controls</a></p>";
	}
	
	if(is_manager_logged_in()) {
		echo "<h3>Manager Controls</h3>";
		echo "<p><a href=\"staff/staff-educates-about-controls.php\">Educates About Controls</a></p>";
		echo "<p><a href=\"staff/employee-controls.php\">Employee Controls</a></p>";
		echo "<p><a href=\"staff/manager-controls.php\">Manager Controls</a></p>";
		echo "<p><a href=\"staff/security-controls.php\">Security Controls</a></p>";
		echo "<p><a href=\"staff/docent-controls.php\">Docent Controls</a></p>";
	}
}

check_login();
?>
<?php include 'ref-links.php';?>
</body>
</html>
