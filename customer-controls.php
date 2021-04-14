<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer controls - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function check_login() {
	if(is_customer_logged_in()) {
		show_customer_controls();
	} else {
		echo "<h1>You are not logged in as a customer!</h1>";
	}
}

function show_customer_controls() {
	global $db_connection;
	
	$id = $_SESSION['customer-id'];
	$sql = "SELECT * FROM CUSTOMER WHERE cid='$id'";
	$result = $db_connection->query($sql);
	$row = $result->fetch_assoc();
	
	$name = $row["Name"];
	echo "<p>Welcome $name. Would you like to logout? <a href=\"customer-logout.php\">Logout</a></p>";
	$eventPageLink = "<a class=\"nav_link\" href=\"customer-event-control.php\"> RSVP to an Event </a>";
	$eventViewPageLink = "</br></br></br></br><a class=\"nav_link\" href=\"customer-event-view.php\"> See my events </a>";
	
	echo $eventPageLink . $eventViewPageLink;

}

check_login();
?>


<?php include 'ref-links.php';?>
</body>
</html>
