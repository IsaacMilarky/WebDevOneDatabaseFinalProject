<?php
include_once 'db_init.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Art - FinalProject</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php include 'shared-header.php';?>
</head>
<body>
<?php include 'navbar.php';?>
<div class="container art" id="art-container">
<?php
function display_art() {
	global $db_connection;
    

    $clause = "";
    $element_format = "";
    foreach($_POST as $key => $submit_elem)
    {
        if($submit_elem !=  "")
        {
            switch($key)
            {
                case 'new-art-name':
                    $element_format = "Name LIKE " . "\"%" . mysqli_real_escape_string($db_connection,$submit_elem) . "%\"";
                break;
                case 'new-art-creator':
                    $element_format = "Creator_name LIKE " . "\"%" . mysqli_real_escape_string($db_connection,$submit_elem) . "%\"";
                break;
                case 'new-art-style':
                    $element_format = "Style LIKE " . "\"%" . mysqli_real_escape_string($db_connection,$submit_elem) . "%\"";
                break;
                case 'new-art-period':
                    $element_format = "Period LIKE " . "\"%" . mysqli_real_escape_string($db_connection,$submit_elem) . "%\"";
                break;
                case 'new-art-timestamp-min':
                    $element_format = "Timestamp>" . "\"" . mysqli_real_escape_string($db_connection,$submit_elem) . "\"";
                break;
                case 'new-art-timestamp-max':
                    $element_format = "Timestamp<" . "\"" . mysqli_real_escape_string($db_connection,$submit_elem) . "\"";
                break;
                case 'new-art-catalog_id':
                    $element_format = "Catalog_id=" . "\"" . mysqli_real_escape_string($db_connection,$submit_elem) . "\"";
                break;
                case 'new-art-price-min':
                    $element_format = "Price>" . "\"" . mysqli_real_escape_string($db_connection,$submit_elem) . "\"";
                break;
                case 'new-art-price-max':
                    $element_format = "Price<" . "\"" . mysqli_real_escape_string($db_connection,$submit_elem) . "\"";
                break;
                default:
                break;
            }
            $clause = $clause . $element_format . " AND ";
        }
    }

    if($clause != "")
    {
        $clause = "WHERE " . $clause;
    }

    $sub = substr($clause, 0, -4);
    $sub = $sub . ";";
    $sql = "SELECT * FROM WORK $sub";
    //echo $sql;
	$result = $db_connection->query($sql);
	
	if($result->num_rows == 0) {
		echo "<th><h3>No results!</h3></th>";
		return;
	}
	
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
	
}

display_art();
?>
</div>
<?php include 'ref-links.php';?>
</body>
</html>
