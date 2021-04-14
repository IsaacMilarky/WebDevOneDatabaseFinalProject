<?php
session_start();
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Login Processing - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function login() {
	
	//debug stuff
	/*
	$id = "no customer id provided";
	$password = "no password provided";
	if(isset($_POST['customer-id'])) {
		$id = $_POST['customer-id'];
	}
	if(isset($_POST['customer-password'])) {
		$password = $_POST['customer-password'];
	}
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	echo "<p>login id: $id </p>";
	echo "<p>login password: $password </p>";
	echo "<p>hashed login password: $hashed_password</p>";
	*/
	

	//actual login stuff
	
	global $db_connection;

	if(isset($_POST['customer-id']) && isset($_POST['customer-password'])) {
		$id = $_POST['customer-id'];
		$password = $_POST['customer-password'];

		if(strcmp($id,"test") == 0)
		{
			$id = 3;
		}
	
		$sql = "SELECT * FROM CUSTOMER WHERE cid='$id'";
		$result = $db_connection->query($sql);
		
		

		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$stored_password = $row["Password"];
			
			if(password_verify($password, $stored_password)) {
				$name = $row["Name"];
				echo "<h3>You are now logged in as $name</h3>";
				echo "<p>Would you like to view customer controls? <a href=\"customer-controls.php\">Customer Controls</a></p>";
				$_SESSION['customer-id'] = $row["cid"];
				$_SESSION['customer-password'] = $row["Password"];
			} else {
				echo "<h3>Password incorrect!</h3>";
			}
		} else {
			echo "<h3>No customer found with ID $id</h3>";
		}
	} else {
		echo "<h3>No ID and/or password provided!</h3>";
	}
}

login();
?>
<?php include 'ref-links.php';?>
</body>
</html>
