<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Login - FinalProject</title>
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
		
	if(is_customer_logged_in()) {
		$id = $_SESSION['customer-id'];
		$sql = "SELECT * FROM CUSTOMER WHERE cid='$id'";
		$result = $db_connection->query($sql);
		$row = $result->fetch_assoc();
		$name = $row["Name"];
		echo "<p>You are already logged in as $name. Would you like to view customer controls? <a href=\"customer-controls.php\">Customer Controls</a></p>";
	}
}
check_login();
?>
<div id="centerContainer">
<form action="customer-login-processing.php" method="post">
	<div class="form-group row">
		<div class="innerContainer">
			<label for="customer-id">Customer ID:</label>
			<input type="text" id="customer-id" class="form-control" name="customer-id"><br>
		</div>
	</div>
	<div class="form-group row">
		<div class="innerContainer">
			<label for="customer-password">Customer password:</label>
			<input type="password" id="customer-password" class="form-control" name="customer-password"><br>
			<input type="submit" class="btn btn-primary">
		</div>
	</div>
</form>
</div>
<?php include 'ref-links.php';?>
</body>
</html>
