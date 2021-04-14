<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Events - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<table class="events">
	<thead>
        <tr>
			<!-- Signifies tabular data for events.-->
            <th class="event-name" scope="col">Event Title</th>
			<th class="event-time" colspan="2">Event Time</th>
        </tr>
    </thead>
	<tbody>
<?php
function display_events() {
	global $db_connection;
	
	$sql = "SELECT * FROM EVENTS";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$time = $row["Timestamp"];
		//Needed to pass html validator.
		$idHolder = $row["Name"];
		$idHolder = str_replace(" ","",$idHolder);
		echo "<tr class=\"event\">\n";
		echo "<th class=\"event-name\">", $row["Name"], "</th>\n";
		echo "<th class=\"event-time\">", $time, "</th>\n";
		echo "<th><form action=\"event-details.php\">";
		echo "<input type=\"hidden\" id=\"event$idHolder\" name=\"event\" value=\"$time\">";
		echo "<input type=\"submit\" value=\"View Details\">";
		echo "</form></th>";
		echo "</tr>\n";
	}
}

display_events();
?>
</tbody>
</table>
<?php include 'ref-links.php';?>
</body>
</html>
