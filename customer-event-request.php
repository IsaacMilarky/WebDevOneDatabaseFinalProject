<?php
session_start();
include_once 'db_init.php';
include_once 'helper_functions.php';
init_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Reservation Confirm - FinalProject</title>
</head>
<body>
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


    //Sign up guests.
    if(!isset($_POST['delete']))
    {
        foreach( $_POST as $requestPrimaryKey)
        {
            $sql = "INSERT INTO TYPICAL_GUESTS VALUES
                ($id,(SELECT Timestamp FROM EVENTS WHERE Name=\"$requestPrimaryKey\"));";
            $result = $db_connection->query($sql);

            //echo $sql;
            if(!$result)
            {
                echo "<h4>Could not rsvp to event $requestPrimaryKey</h4><br>\n";
                echo "<p>Make sure you aren't already signed up for this event</p>";
                return;
            }   
        }
        
    }
    else
    {
        foreach( $_POST as $requestPrimaryKey)
        {
            $sql = "DELETE FROM TYPICAL_GUESTS WHERE Event_time=\"$requestPrimaryKey\";";
            $result = $db_connection->query($sql);
            if(!$result)
            {
                //echo $sql;
                echo "<h4>Could not remove your reservation to event $requestPrimaryKey</h4>\n";
                return;
            }
            //echo $sql;
        }
    }
    
    echo "<h4>Request successful!</h4>\n";
    
}
check_login();
?>

</body>
</html>