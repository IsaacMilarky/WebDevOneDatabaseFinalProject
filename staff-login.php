<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home - FinalProject</title>
<?php include 'shared-header.php';?>
<style>
	#centerContainer {
		width: 50%;
		margin: 0 auto;
	}
	.innerContainer {
		width: 50%;
		margin: 0 auto;
		
	}
</style>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function check_login() {
	global $db_connection;
		
	if(is_staff_logged_in()) {
		$id = $_SESSION['staff-id'];
		$sql = "SELECT * FROM EMPLOYEE WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		$row = $result->fetch_assoc();
		$name = $row["Name"];
		echo "<p>You are already logged in as $name. Would you like to view staff controls? <a href=\"staff-controls.php\">Staff Controls</a></p>";
	}
}
check_login();
?>
<div id="centerContainer">
<form action="staff-login-processing.php" method="post">
	<div class="form-group row">	
		<div class="innerContainer">
			<label for="staff-id">Staff ID:</label>
			<input type="text" id="staff-id" class="form-control" name="staff-id"><br>
		</div>
	</div>
	<div class="form-group row">
		<div class="innerContainer">
			<label for="staff-password">Staff password:</label>
			<input type="password" id="staff-password" class="form-control" name="staff-password"><br>
			<input type="submit" class="btn btn-primary">
		</div>
	</div>
</form>
</div>
<?php include 'ref-links.php';?>
</body>
</html>
