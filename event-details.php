<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Event Details - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<?php
function display_art() {
	global $db_connection;
	
	if(isset($_GET['event'])) {
		$id = $_GET['event'];
		
		if(empty($id)) {
			echo "<h3>Event not provided!</h3>";
			return;
		}
		
		$sql = "SELECT * FROM EVENTS WHERE Timestamp='$id';";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<h3>Event not found!</h3>";
			return;
		}
		
		$row = $result->fetch_assoc();

		//Might be tabular data but don't want to risk it.
		echo '<div class="event_details">';
		echo "<span class=\"event-name\">Event Title:</span>";
		echo "<p class=\"gen-text-info\">", $row["Name"], "</p><br>";
		echo "<span class=\"event-name\">Event Time:</span>";
		echo "<p class=\"gen-text-info\">", $row["Timestamp"], "</p><br>";
		
		
		$sql = "SELECT * FROM (SELECT * FROM WORKS_AT_EVENTS WHERE Event_time='$id') AS a INNER JOIN WORK AS b ON a.Work=b.Catalog_id";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<span class=\"notice-text\">No Art at Event</span><br>";
		} else {
			echo "<span class=\"event-name\">Art at Event:</span>";
			foreach($result as $row) {
				$name = $row["Name"];
				echo "<p class=\"gen-text-info\">$name</p><br>";
			}
		}
		
		
		$sql = "SELECT * FROM ARTIST_GUESTS WHERE Event_time='$id';";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<span class=\"notice-text\">No Artists at Event</span><br>";
		} else {
			echo "<span class=\"event-name\">Artists at Event:</span>";
			foreach($result as $row) {
				$name = $row["Artist"];
				echo "<p class=\"gen-text-info\">$name</p><br>";
			}
		}
		
		
		$sql = "SELECT * FROM (SELECT * FROM CRITIC_GUESTS WHERE Event_time='$id') AS a INNER JOIN CRITIC AS b ON a.cid=b.cid";
		$result = $db_connection->query($sql);
		
		if($result->num_rows == 0) {
			echo "<span class=\"notice-text\">No Critics at Event</span><br>";
		} else {
			echo "<span class=\"event-name\">Critics at Event:</span>";
			foreach($result as $row) {
				$name = $row["Name"];
				echo "<p class=\"gen-text-info\">$name</p><br>";
			}
		}
		
		echo "</div>";
		
	} else {
		echo "<h3>Art not provided!</h3>";
	}
}

display_art();
?>
<?php include 'ref-links.php';?>
</body>
</html>
