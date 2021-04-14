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
	
	echo "<form action=\"create-customer.php\" method=\"post\">";
	echo "<label for=\"new-customer-id\">Customer id:</label>";
	echo "<input type=\"text\" id=\"new-customer-id\" name=\"new-customer-id\">";
	echo "<label for=\"new-customer-name\">Customer name:</label>";
	echo "<input type=\"text\" id=\"new-customer-name\" name=\"new-customer-name\">";
	echo "<label for=\"new-customer-email\">Customer email:</label>";
	echo "<input type=\"text\" id=\"new-customer-email\" name=\"new-customer-email\">";
	echo "<label for=\"new-customer-password\">Customer password:</label>";
	echo "<input type=\"text\" id=\"new-customer-password\" name=\"new-customer-password\">";
	echo "<input type=\"submit\" value=\"Create New Customer\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM CUSTOMER";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-customer.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"customer-id\" name=\"customer-id\" value=\"", $row["cid"], "\">";
		echo "<label for=\"new-customer-id\">Customer id:</label>";
		echo "<input type=\"text\" id=\"new-customer-id\" name=\"new-customer-id\" value=\"", $row["cid"], "\">";
		echo "<label for=\"new-customer-name\">Customer name:</label>";
		echo "<input type=\"text\" id=\"new-customer-name\" name=\"new-customer-name\" value=\"", $row["Name"], "\">";
		echo "<label for=\"new-customer-email\">Customer email:</label>";
		echo "<input type=\"text\" id=\"new-customer-email\" name=\"new-customer-email\" value=\"", $row["Email"], "\">";
		echo "<label for=\"new-customer-password\">Customer password:</label>";
		echo "<input type=\"text\" id=\"new-customer-password\" name=\"new-customer-password\">";
		echo "<input type=\"submit\" value=\"Update Customer Information\">";
		echo "<input type=\"submit\" value=\"Delete Customer\" formaction=\"delete-customer.php\">";
		echo "</form>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
