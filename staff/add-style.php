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

<script></script>
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
    
    $artist = $_POST['new-art-style'];
    $style = $_POST['artist-style-addition'];

    if(!isset($_POST['Add-Style']))
    {
        //remove style to table
        $sql = "DELETE FROM ARTIST_STYLE WHERE (Artist=\"$artist\" AND Style=\"$style\");";
        $result = $db_connection->query($sql);
        if(!$result)
        {
            
            echo "<h1>Failed to remove style from artist!</h1>";
        }
        else
        {
            echo "<h1>Style has been removed from the selected artist </h1>";
        }
    }
    else 
    {
        
        //Assume add style.
        $sql = "INSERT INTO ARTIST_STYLE VALUES
            (\"$artist\",\"$style\");";
        $result = $db_connection->query($sql);
        if(!$result)
        {
            echo "<h1>Failed to add style to artist!</h1>";
            
        }
        else
        {
            echo "<h1>Style has been added to the selected artist </h1>";
        }
    }
}

check_login();
?>
<?php include '../ref-links.php';?>
</body>
</html>
