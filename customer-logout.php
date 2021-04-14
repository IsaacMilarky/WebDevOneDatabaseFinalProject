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
function staff_logout() {
	unset($_SESSION['customer-id']);
	unset($_SESSION['customer-password']);
	echo "<h3>You have been logged out of your customer account</h3>";
}

staff_logout();
?>
<?php include 'ref-links.php';?>
</body>
</html>
