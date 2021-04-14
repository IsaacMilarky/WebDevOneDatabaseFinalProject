<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Art - FinalProject</title>
<?php include '../shared-header.php';?>
</head>
<body>
<?php include '../navbar.php';?>
<?php 
function check_login() {
	if(is_staff_logged_in()) {
		echo "<p><a href=\"staff-art-controls.php\">Art Controls</a></p>";
		create_event();
	} else {
		echo "<h1>You are not logged in as a staff member!</h1>";
	}
}

function create_event() {
	/* using these pages as refernece for file upload:
	https://www.w3schools.com/php/php_file_upload.asp
	https://www.php.net/manual/en/features.file-upload.post-method.php
	*/
	
	global $db_connection;

	if(isset($_POST['art-id']) && 
		isset($_POST['new-art-name']) && 
		isset($_POST['new-art-style']) && 
		isset($_POST['new-art-period']) && 
		isset($_POST['new-art-timestamp']) && 
		isset($_POST['new-art-catalog_id']) && 
		isset($_POST['new-art-price']) && 
		isset($_FILES['new-art-photo']) && 
		isset($_POST['new-art-description']) && 
		isset($_POST['new-art-location']) && 
		isset($_POST['new-art-creator'])) {
			
		$old_id = $_POST['art-id'];
		$name = $_POST['new-art-name'];
		$style = $_POST['new-art-style'];
		$period = $_POST['new-art-period'];
		$timestamp = $_POST['new-art-timestamp'];
		$catalog_id = $_POST['new-art-catalog_id'];
		$price = $_POST['new-art-price'];
		$photo = $_FILES['new-art-photo']['name'];
		$description = $_POST['new-art-description'];
		$location = $_POST['new-art-location'];
		$creator = $_POST['new-art-creator'];
		
		if(empty($old_id) || 
			empty($name) || 
			empty($style) || 
			empty($period) || 
			empty($timestamp) || 
			empty($catalog_id) || 
			empty($price) || 
			empty($description) || 
			empty($location) || 
			empty($creator)) {
			echo "<h3>Form was not fully filled out!</h3>";
			return;
		}
	
		//SQL injection protection
		$name = mysqli_real_escape_string($db_connection, $name);
		$style = mysqli_real_escape_string($db_connection, $style);
		$period = mysqli_real_escape_string($db_connection,$period);
		$timestamp = mysqli_real_escape_string($db_connection, $timestamp);
		$catalog_id = mysqli_real_escape_string($db_connection, $catalog_id);
		$price = mysqli_real_escape_string($db_connection, $price);
		$description = mysqli_real_escape_string($db_connection, $description);
		$location = mysqli_real_escape_string($db_connection, $location);
		$creator = mysqli_real_escape_string($db_connection, $creator);

		$sql = "UPDATE WORK SET Name='$name', Style='$style', Period='$period', Timestamp='$timestamp', Catalog_id='$catalog_id', Price='$price', Description='$description', Room_loc='$location', Creator_name='$creator'";
		
		if(empty($photo) == False) {
			if(move_uploaded_file($_FILES['new-art-photo']['tmp_name'], "../art/$photo") == True) {
				$sql .= ", Photo='$photo'";
			} else {
				echo "Failed to move photo to correct location";
			}
		}
		
		$sql .= " WHERE Catalog_id='$old_id';";
	
		//$sql = "INSERT INTO WORK VALUES ('$name', '$style', '$period', '$timestamp', '$catalog_id', '$price', '$photo', '$description', '$location', '$creator');";
		
		$result = $db_connection->query($sql);
		
		if($result) {
			echo "<p>Sucsessfully updated art.</p>";
		}
		else {
			echo $sql;
			echo "<p>Error updating art:</p>";
			echo "<p>", $db_connection->error, "</p>";
		}
	} else {
		echo "<h3>Form was not fully filled out!</h3>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
