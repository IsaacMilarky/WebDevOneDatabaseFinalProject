<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff review controls - FinalProject</title>
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
	
	echo "<form action=\"create-review.php\" method=\"post\">";
	echo "<label for=\"new-review-title\">Review title:</label>";
	echo "<input type=\"text\" id=\"new-review-title\" name=\"new-review-title\"></br>";
	echo "<label for=\"new-review-author\">Critic Name:</label>";
	echo "<select id=\"new-review-author\" name=\"new-review-author\">";
	$sql = "SELECT * FROM CRITIC";
	$critics = $db_connection->query($sql);
	foreach($critics as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["cid"], "\">", $row["Name"], "</option>";
	}
	echo "</select></br>";
	echo "<label for=\"new-review-date\">Review date:</label>";
	echo "<input type=\"text\" id=\"new-review-date\" name=\"new-review-date\"></br>";
	echo "<label for=\"new-review-text\">Review text:</label></br>";
	echo "<textarea rows=\"10\" cols=\"50\" id=\"new-review-text\" name=\"new-review-text\"></textarea></br>";
	echo "<input type=\"submit\" value=\"Create New Review\">";
	echo "</form></br>";
	
	$sql = "SELECT * FROM REVIEW";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		echo "<form action=\"update-review.php\" method=\"post\">";
		echo "<input type=\"hidden\" id=\"review-title\" name=\"review-title\" value=\"", $row["Title"], "\">";
		echo "<input type=\"hidden\" id=\"review-author\" name=\"review-author\" value=\"", $row["Author"], "\">";
		echo "<label for=\"new-review-title\">Review title:</label>";
		echo "<input type=\"text\" id=\"new-review-title\" name=\"new-review-title\" value=\"", $row["Title"], "\">", "</br>";
		echo "<label for=\"new-review-author\">Critic Name:</label>";
		echo "<select id=\"new-review-author\" name=\"new-review-author\">";
		$sql = "SELECT * FROM CRITIC";
		$critics = $db_connection->query($sql);
		foreach($critics as $critic) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $critic["cid"], "\""; 
			if($critic["cid"] == $row["Author"]) {
				echo " selected";
			}
			echo ">", $critic["Name"], "</option>";
		}
		echo "</select></br>";
		echo "<label for=\"new-review-date\">Review date:</label>";
		echo "<input type=\"text\" id=\"new-review-date\" name=\"new-review-date\" value=\"", $row["Date_published"], "\"></br>";
		echo "<label for=\"new-review-text\">Review text:</label></br>";
		echo "<textarea rows=\"10\" cols=\"50\" id=\"new-review-text\" name=\"new-review-text\">", $row["Body_text"], "</textarea></br>";
		echo "<input type=\"submit\" value=\"Update Review\">";
		echo "<input type=\"submit\" value=\"Delete Review\" formaction=\"delete-review.php\">";
		echo "</form></br>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
