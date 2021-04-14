<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer controls - FinalProject</title>
<?php include 'shared-header.php';?>
<script>
//AJAX Requests handled here.
//Doesn't reload page afterwards.
$(document).ready(function(){
	$("form").on("submit", function(event){
		event.preventDefault();

		var formVals = $(this).serialize();
		$.post("customer-event-request.php", formVals, function(data){
			$("#result").html(data);
        });
        
	});

	//Easy radial button for checkboxes.
	$(".radial").change(function() {
    $(".radial").prop('checked', false);
    $(this).prop('checked', true);
	});
});
</script>
</head>
<body>
<?php include 'navbar.php';?>
<?php 
function check_login() {
	if(is_customer_logged_in()) {
		show_event_controls();
	} else {
		echo "<h1>You are not logged in as a customer!</h1>";
	}
}

function show_event_controls() {
	global $db_connection;
	
	$id = $_SESSION['customer-id'];
	$sql = "SELECT * FROM CUSTOMER WHERE cid='$id';";
	$result = $db_connection->query($sql);
	$row = $result->fetch_assoc();
	
	$name = $row["Name"];
	echo "<p>Welcome $name. Would you like to logout? <a href=\"customer-logout.php\">Logout</a></p>";
    
    //Get events and put them in a table.
    $sql = "SELECT Name,Timestamp FROM EVENTS WHERE Timestamp>NOW();";
	$result = $db_connection->query($sql);
	//$row = $result->fetch_assoc();

	echo "<h1>Open Events</h1>";

	echo "<form>";
	echo "<table class=\"events\">";
	echo "<thead><tr><!-- Signifies tabular data for events.-->";
	echo "<th class=\"event-name\" scope=\"col\">Event Title</th>";
	echo "<th class=\"event-time\" colspan=\"2\">Event Time</th>";
	echo "</tr></thead><tbody>";
	$count = 0;
	foreach($result as $row) {
		$time = $row["Timestamp"];
		echo "<tr class=\"event\">\n";
		echo "<th class=\"event-name\">", $row["Name"], "</th>\n";
		echo "<th class=\"event-time\">", $time, "</th>\n";
		//Checkbox for form RSVP
		echo "<th class=\"event-time\">"; 
		echo "<input type=\"checkbox\" ";
		//Increment for each event checked.
		echo "id=\"event", ++$count,"\" class=\"radial\" name=\"RSVP\"";
		echo " value=\"",$row["Name"],"\">";
		echo "</th>\n";
		echo "</tr>\n";
	}
	echo "</tbody></table>";
	echo "<br><input type=\"submit\" class=\"btn btn-primary\">";
	echo "</form>";
	echo "<div id=\"result\"></div>";
}
check_login();
?>


<?php include 'ref-links.php';?>
</body>
</html>