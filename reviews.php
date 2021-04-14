<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Reviews - FinalProject</title>
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>

<?php
function display_events() {
	global $db_connection;
	
	$sql = "SELECT * FROM REVIEW INNER JOIN CRITIC ON REVIEW.Author=CRITIC.cid;";
	$result = $db_connection->query($sql);

	foreach($result as $row) {
		$title = $row["Title"];
		$date = $row["Date_published"];
		$author = $row["Name"];
		$country = $row["Country"];
		$text = $row["Body_text"];
		echo '<div class="review">';
		echo "<h3>$title</h3>";
		echo "<h5>published on $date <br>by $author from $country</h5>";
		echo "<p>$text</p>";
		echo '</div><br>';
	}
}

display_events();
?>
<?php include 'ref-links.php';?>
</body>
</html>
