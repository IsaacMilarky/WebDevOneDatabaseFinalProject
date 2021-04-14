<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Art Details - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<div class="centerCaptionSpotlight">
<?php
function display_art() {
	global $db_connection;
	
	if(isset($_GET['catalog_id'])) {
		$id = $_GET['catalog_id'];
		
		if(empty($id)) {
			echo "<h3>Art not provided!</h3>";
			return;
		}
		
		$sql = "SELECT * FROM (SELECT * FROM WORK WHERE Catalog_id=$id) AS a INNER JOIN (SELECT Name as Artist_name, Country, Date_of_birth FROM ARTIST) AS b ON a.Creator_name=b.Artist_name;";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<h3>Art not found!</h3>";
			return;
		}
		
		$row = $result->fetch_assoc();

		echo "<div class=\"imageWide\">";
		echo "<img class=\"art\" src=\"art/", $row["Photo"], "\" alt=\"art/", $row["Photo"], "\">\n";
		echo "<ul class=\"list-group\">\n";
		echo "<li class=\"list-group-item\">Name: ", $row["Name"], "</li>\n";
		echo "<li class=\"list-group-item\">Artist: ", $row["Creator_name"], "</li>\n";
		echo "<li class=\"list-group-item\">Creation Date: ", $row["Timestamp"], "</li>\n";
		echo "<li class=\"list-group-item\">Description: ", $row["Description"], "</li>\n";
		echo "<li class=\"list-group-item\">Artist Country: ", $row["Country"], "</li>\n";
		echo "<li class=\"list-group-item\">Artist Date of Birth: ", $row["Date_of_birth"], "</li>\n";
		echo "<li class=\"list-group-item\">Style: ", $row["Style"], "</li>\n";
		echo "<li class=\"list-group-item\">Period: ", $row["Period"], "</li>\n";
		echo "<li class=\"list-group-item\">Price: ", $row["Price"], "</li>\n";
		echo "<li class=\"list-group-item\">Room Location: ", $row["Room_loc"], "</li>\n";
		echo "<li class=\"list-group-item\">Catalog id: ", $row["Catalog_id"], "</li>\n";
		
		$sql = "SELECT * FROM (SELECT * FROM EDUCATES_ABOUT WHERE Catalog_id=$id) AS a INNER JOIN EMPLOYEE AS b ON a.SSN=b.SSN";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<li class=\"list-group-item\">No Assigned Docents</li>\n";
		} else {
			echo "<li class=\"list-group-item\">Assigned Docents:";
			foreach($result as $row) {
				$name = $row["Name"];
				echo "$name \n";
			}
			echo "</li>\n";
		}
		
		$sql = "SELECT * FROM (SELECT * FROM WORKS_AT_EVENTS WHERE Work=$id) AS a INNER JOIN EVENTS AS b ON a.Event_time=b.Timestamp;";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<li class=\"list-group-item\">No events featuring this work</li>\n";
		} else {
			echo "<li class=\"list-group-item\">Events featuring this work:";
			foreach($result as $row) {
				$name = $row["Name"];
				echo "$name \n";
			}
			echo "</li>\n";
		}
		
		echo "</ul></div>";
		
	} else {
		echo "<h3>Art not provided!</h3>";
	}
}

display_art();
?>
</div>
<?php include 'ref-links.php';?>
</body>
</html>
