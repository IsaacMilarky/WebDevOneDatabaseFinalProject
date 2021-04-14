<?php
session_start();
include_once '../db_init.php';
include_once '../helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff art controls - FinalProject</title>
<?php include '../shared-header.php';?>

<style>
	#imageWrapper {
		border: 1px solid black;
	}

	#staff-art-div {
		width: 60%;
	}

	#artistStyleTableData {
		border-right: 1px solid black;
	}
</style>
<script>
//Javascript requirement now filled.

function verifyStyleField() {
	var fieldAlert = document.getElementById("artist-style-addition");
	console.log(fieldAlert.value.trim());
	if(fieldAlert.value.trim() == "")
	{
		var confirmation = confirm("Are you sure you want to input a blank style?");
		if(!confirmation)
		{
			return false;
		}
	}
	return true;
}

function verifyAllFields() {
    var fieldAlert = document.getElementsByClassName("verify");
    for(var iter = 0; iter < fieldAlert.length; iter++)
    {
        if(fieldAlert[iter].value.trim() == "")
        {
            alert("Please Fill Out All Fields Before Adding Artwork!");
            return false;
        }
    }
    return true;
}
</script>
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
	/* using these pages as refernece for file upload:
	https://www.w3schools.com/php/php_file_upload.asp
	https://www.php.net/manual/en/features.file-upload.post-method.php
	*/
	
	global $db_connection;
	
	echo "<p>Would you like to go back to main staff controls? <a href=\"../staff-controls.php\">Staff Controls</a></p>";
	echo "<div class=\"container art\" id=\"art-container\">";
	//Art style form
	
	echo "<div class=\"form-group mb-3 col-xs-2 col\" id=\"staff-art-div\">";
	echo "<h2>Add or Remove a style from an artist</h2>";
	echo "<form action=\"add-style.php\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<label for=\"new-art-style\"> Artist</label>";
	echo "<select class=\"custom-select\"id=\"new-art-style\" name=\"new-art-style\">";
	$sql = "SELECT * FROM ARTIST;";
	$result = $db_connection->query($sql);
	foreach($result as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["Name"], "\">", $row["Name"], "</option>";
	}
	echo "</select><br>";
	echo "<label for=\"artist-style-addition\"> Style:</label>";
	echo "<input type=\"text\" class=\"form-control\" id=\"artist-style-addition\" name=\"artist-style-addition\"><br>";
	echo "<input type=\"submit\" class=\"btn\" value=\"Add-Style\" name=\"Add-Style\" onclick=\"return verifyStyleField()\">";
	echo "<input type=\"submit\" class=\"btn\" value=\"Remove Style\" name=\"Remove Style\" onclick=\"return verifyStyleField()\">";
	echo "</form><br>";
	
	$sql = "SELECT * FROM ARTIST_STYLE";
	$result = $db_connection->query($sql);

	echo '<table class="events">';
	echo "<thead><tr><!-- Signifies tabular data for events.-->";
	echo "<th class=\"event-name\" scope=\"col\">Artist</th>";
	echo "<th class=\"event-time\" colspan=\"2\">Artist Style</th></tr></thead>";
	echo "<tbody>";
	foreach($result as $row) {
		echo "<tr class=\"event\">\n";
		echo "<th class=\"event-name\">", $row["Artist"], "</th>\n";
		echo "<th class=\"event-time\" id=\"artistStyleTableData\">", $row["Style"], "</th>\n";
		echo "</tr>\n";
	}
	echo '</tbody></table></br>';
	echo "<form id=\"add-art-form\" action=\"add-art.php\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<h4>Add art to database:</h4>";
	echo "<label for=\"new-art-name\">Art name:</label>";
	echo "<input type=\"text\" class=\"form-control verify\" id=\"new-art-name\" name=\"new-art-name\"><br>";
	echo "<label for=\"new-art-style\">Art style:</label>";
	echo "<input type=\"text\" class=\"form-control verify\" id=\"new-art-style\" name=\"new-art-style\"><br>";
	echo "<label for=\"new-art-period\">Art Period:</label>";
	echo "<input type=\"text\" id=\"new-art-period\" class=\"form-control verify\" name=\"new-art-period\"><br>";
	echo "<label for=\"new-period-timestamp\">Art Timestamp:</label>";
	echo "<input type=\"text\" id=\"new-art-timestamp\" class=\"form-control verify\" name=\"new-art-timestamp\"><br>";
	echo "<label for=\"new-art-catalog_id\">Art Catalog ID:</label>";
	echo "<input type=\"text\" id=\"new-art-catalog_id\" class=\"form-control verify\" name=\"new-art-catalog_id\"><br>";
	echo "<label for=\"new-art-price\">Art Price:</label>";
	echo "<input type=\"text\" id=\"new-art-price\" class=\"form-control verify\" name=\"new-art-price\"><br>";
	echo "<div class=\"custom-file\">";
	echo "<label class=\"custom-file-label\" for=\"new-art-photo\">Art Photo:</label>";
	echo "<input type=\"file\" accept=\"image/*\" id=\"new-art-photo\" class=\"custom-file-input\" name=\"new-art-photo\"><br>";
	echo "</div>";
	echo "<label for=\"new-art-description\">Art Description:</label>";
	echo "<input type=\"text\" id=\"new-art-description\" class=\"form-control verify\" name=\"new-art-description\"><br>";
	echo "<label for=\"new-art-location\">Art Room Location:</label>";
	echo "<select id=\"new-art-location\" class=\"custom-select verify\" name=\"new-art-location\">";
	$sql = "SELECT * FROM ROOM";
	$rooms = $db_connection->query($sql);
	foreach($rooms as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["Location"], "\">", $row["Location"], "</option>";
	}
	echo "</select><br>";
	echo "<label for=\"new-art-creator\">Art Creator Name:</label>";
	echo "<select id=\"new-art-creator\" class=\"custom-select verify\" name=\"new-art-creator\">";
	$sql = "SELECT * FROM ARTIST";
	$artists = $db_connection->query($sql);
	foreach($artists as $row) {
		//following this example https://www.w3schools.com/html/html_form_elements.asp
		echo "<option value=\"", $row["Name"], "\">", $row["Name"], "</option>";
	}
	echo "</select><br>";
	echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Add Art\" onclick=\"return verifyAllFields()\">";
	echo "</form></div><br>\n";
	
	
	$sql = "SELECT * FROM WORK";
	$result = $db_connection->query($sql);

	echo "<div class=\"col overLimit\" id=\"imageWrapper\">";
	foreach($result as $row) {
		$room = $row["Room_loc"];
		$artist = $row["Creator_name"];
		
		echo "<div class=\"imageWide\"><div>";
		echo "<img class=\"art\" src=\"../art/", $row["Photo"], "\">";
		echo "</div><div class=\"form-group mb-3 col-xs-2\">";
		echo "<form action=\"update-art.php\" method=\"post\" enctype=\"multipart/form-data\">";
		echo "<input type=\"hidden\" id=\"art-id\" name=\"art-id\" value=\"", $row["Catalog_id"], "\">";
		echo "<label for=\"new-art-name\">Art name:</label>";
		echo "<input type=\"text\" id=\"new-art-name\" name=\"new-art-name\" value=\"", $row["Name"], "\">";
		echo "</br><label for=\"new-art-style\">Art style:</label>";
		echo "<input type=\"text\" id=\"new-art-style\" name=\"new-art-style\" value=\"", $row["Style"], "\">";
		echo "</br><label for=\"new-art-period\">Art Period:</label>";
		echo "<input type=\"text\" id=\"new-art-period\" name=\"new-art-period\" value=\"", $row["Period"], "\">";
		echo "</br><label for=\"new-period-timestamp\">Art Timestamp:</label>";
		echo "<input type=\"text\" id=\"new-art-timestamp\" name=\"new-art-timestamp\" value=\"", $row["Timestamp"], "\">";
		echo "</br><label for=\"new-art-catalog_id\">Art Catalog ID:</label>";
		echo "<input type=\"text\" id=\"new-art-catalog_id\" name=\"new-art-catalog_id\" value=\"", $row["Catalog_id"], "\">";
		echo "</br><label for=\"new-art-price\">Art Price:</label>";
		echo "<input type=\"text\" id=\"new-art-price\" name=\"new-art-price\" value=\"", $row["Price"], "\">";
		echo "</br><label for=\"new-art-photo\">Art Photo:</label>";
		echo "<input type=\"file\" accept=\"image/*\" id=\"new-art-photo\" name=\"new-art-photo\">";
		echo "</br><label for=\"new-art-description\">Art Description:</label>";
		echo "<input type=\"text\" id=\"new-art-description\" name=\"new-art-description\" value=\"", $row["Description"], "\">";
		echo "</br><label for=\"new-art-location\">Art Room Location:</label>";
		echo "<select id=\"new-art-location\" name=\"new-art-location\">";
		$sql = "SELECT * FROM ROOM";
		$rooms = $db_connection->query($sql);
		foreach($rooms as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["Location"], "\"";
			if($row["Location"] == $room) {
				echo " selected";
			}
			echo ">", $row["Location"], "</option>";
		}
		echo "</select>";
		echo "</br><label for=\"new-art-creator\">Art Creator Name:</label><br>";
		echo "<select id=\"new-art-creator\" name=\"new-art-creator\">";
		$sql = "SELECT * FROM ARTIST";
		$artists = $db_connection->query($sql);
		foreach($artists as $row) {
			//following this example https://www.w3schools.com/html/html_form_elements.asp
			echo "<option value=\"", $row["Name"], "\"";
			if($row["Name"] == $artist) {
				echo " selected";
			}
			echo ">", $row["Name"], "</option>";
		}
		echo "</select>";
		echo "</br><input type=\"submit\" value=\"Update Art\">";
		echo "<input type=\"submit\" value=\"Delete Art\" formaction=\"delete-art.php\">";
		echo "</th></tr></table>";
		echo "</form>\n</div></div>";
	}
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
