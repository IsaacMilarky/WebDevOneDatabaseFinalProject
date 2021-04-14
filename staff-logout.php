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
function staff_logout() {
	unset($_SESSION['staff-id']);
	unset($_SESSION['staff-password']);
	echo "<h3>You have been logged out of your staff account</h3>";
}

staff_logout();
?>
<?php include 'ref-links.php';?>
</body>
</html>
