<?php
session_start();
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff login processing - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function login() {
	
	//debug stuff
	/*
	$id = "no staff id provided";
	$password = "no password provided";
	if(isset($_POST['staff-id'])) {
		$id = $_POST['staff-id'];
	}
	if(isset($_POST['staff-password'])) {
		$password = $_POST['staff-password'];
	}
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	echo "<p>login id: $id </p>";
	echo "<p>login password: $password </p>";
	echo "<p>hashed login password: $hashed_password</p>";
	*/
	//actual login stuff
	
	global $db_connection;

	if(isset($_POST['staff-id']) && isset($_POST['staff-password'])) {
		$id = $_POST['staff-id'];
		$password = $_POST['staff-password'];
	

		//Required for requirements.
		if(strcmp($id,"test") == 0)
		{
			$id = 1;
		}
		$sql = "SELECT * FROM EMPLOYEE WHERE SSN='$id'";
		$result = $db_connection->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$stored_password = $row["Password"];
			
			echo "<br>\n";
			if(password_verify($password, $stored_password) ) {
				$name = $row["Name"];
				echo "<h3>You are now logged in as $name</h3>";
				echo "<p>Would you like to view staff controls? <a href=\"staff-controls.php\">Staff Controls</a></p>";
				$_SESSION['staff-id'] = $row["SSN"];
				$_SESSION['staff-password'] = $row["Password"];
			} else {
				echo "<h3>Password incorrect!</h3>";
			}
		} else {
			echo "<h3>No staff found with ID $id</h3>";
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
