<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Art - FinalProject</title>
<?php include 'shared-header.php';?>
<script>
//Jquery requirement filled once more
$(document).ready(function(){
	$(".imageWide").click(function(){
		$(".imageWide").css("border","none");
		$(this).css("border","2px solid black");
	});
});
</script>
</head>
<body>
<?php include 'navbar.php';?>
<div class="container art" id="art-container">
<?php
function display_art() {
	global $db_connection;
	
	$sql = "SELECT * FROM WORK";
	$result = $db_connection->query($sql);
	
	echo "<div class = \"row art overLimit\">\n";
	foreach($result as $row) {
		$id = $row["Catalog_id"];
		echo "<div class=\"imageWide\">\n";
		echo "<img class=\"art\" src=\"art/", $row["Photo"], "\" alt=\"art/", $row["Photo"], "\">\n";
		echo "<ul class=\"list-group\">\n";
		echo "<li class=\"list-group-item\">Name: ", $row["Name"], "</li>\n";
		echo "<li class=\"list-group-item\">Artist: ", $row["Creator_name"], "</li>\n";
		echo "<li class=\"list-group-item\">";
		echo "<form action=\"art-details.php\">";
		echo "<input type=\"hidden\" id=\"catalog_id$id\" name=\"catalog_id\" value=\"$id\">";
		echo "<input type=\"submit\" value=\"View Details\">";
		echo "</form></li></ul>";
		echo "</div>\n";
	}
	echo "</div>";
	
	echo "<div class=\"row art\">";
	echo "<h2>Filter Works</h2>";
	echo "<p>Filter art based on criteria</p>";
	echo "</div>";
	//Art style form
	
	echo "<form action=\"art-filter.php\" method=\"post\" enctype=\"multipart/form-data\">";

	echo "<div class=\"row form-group mb-3 col-xs-4\" id=\"art-form-div\">";
	echo "<label for=\"new-art-name\">Art name:</label>";
	echo "<input type=\"text\" id=\"new-art-name\" name=\"new-art-name\">";
	echo "<br><label for=\"new-art-creator\">Artist name:</label>";
	echo "<input type=\"text\" id=\"new-art-creator\" name=\"new-art-creator\">";
	echo "<br><label for=\"new-art-style\">Art style:</label>";
	echo "<input type=\"text\" id=\"new-art-style\" name=\"new-art-style\">";
	echo "<br><label for=\"new-art-period\">Art Period:</label>";
	echo "<input type=\"text\" id=\"new-art-period\" name=\"new-art-period\">";
	echo "<br><label for=\"new-art-timestamp-min\">Art Year Minimum:</label>";
	echo "<input type=\"text\" id=\"new-art-timestamp-min\" name=\"new-art-timestamp-min\">";
	echo "<br><label for=\"new-art-timestamp-max\">Art Year Maximum:</label>";
	echo "<input type=\"text\" id=\"new-art-timestamp-max\" name=\"new-art-timestamp-max\">";
	echo "<br><label for=\"new-art-catalog_id\">Art Catalog ID:</label>";
	echo "<input type=\"text\" id=\"new-art-catalog_id\" name=\"new-art-catalog_id\">";
	echo "<br><label for=\"new-art-price-max\">Art Price Max:</label>";
	echo "<input type=\"text\" id=\"new-art-price-max\" name=\"new-art-price-max\">";
	echo "<br><label for=\"new-art-price-min\">Art Price Min:</label>";
	echo "<input type=\"text\" id=\"new-art-price-min\" name=\"new-art-price-min\">";
	echo "<br><input type=\"submit\">";
	echo "</div></form>";
}

display_art();
?>

</div>
<?php include 'ref-links.php';?>
</body>
</html>
