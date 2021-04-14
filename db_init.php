<?php
include_once 'db_vars.php';

function init_db() {
	global $db_connection, $db_name;
	connect_db();
	create_db();
	$db_connection->select_db($db_name);
	create_tables();
}

function connect_db() {
	global $db_connection, $db_server, $db_username, $db_password;
	$db_connection = mysqli_connect($db_server, $db_username, $db_password);
	if (!$db_connection) {
		die("Connection failed: " . mysqli_connect_error());
	}
}

function create_db() {
	global $db_connection, $db_name;
	$sql = "CREATE DATABASE " . $db_name;
	$db_connection->query($sql);//try to add a check if the DB exists so an error can be printed on failure
}

function create_tables() {
	create_room_table();
	create_artist_table();
	create_work_table();
	create_events_table();
	create_employee_table();
	create_docent_table();
	create_security_table();
	create_manager_table();
	create_customer_table();
	create_critic_table();
	create_review_table();
	create_typical_guests_table();
	create_educates_about_table();
	create_artist_guests_table();
	create_artist_style_table();
	create_works_at_events_table();
	create_critic_guests_table();
}

function create_room_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE ROOM(
		Theme		VARCHAR(255)	NOT NULL,
		Location	VARCHAR(255),
		PRIMARY KEY (Location)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		//Only one gallery
		$sql = "INSERT INTO ROOM VALUES
			('Leonardo da Vinci', 'Floor 1, South West'),
			('Modernism', 'Floor 1, South East');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_artist_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE ARTIST(
		Name			VARCHAR(255),
		Country			VARCHAR(255)	NOT NULL,
		Date_of_birth	Date			NOT NULL,
		PRIMARY KEY (Name)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO ARTIST VALUES
			('Leonardo da Vinci', 'Italy', '1452-4-15'),
			('Norman Rockwell', 'United States','1894-2-3'),
			('Vincent Van Gogh', 'The Netherlands','1853-3-30');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_work_table() {
	global $db_connection;
	
	//maybe make catalog_id auto increment or something?
	$sql = "CREATE TABLE WORK(
		Name		VARCHAR(255)	NOT NULL,
		Style		VARCHAR(255)	NOT NULL,
		Period		VARCHAR(255)	NOT NULL,
		Timestamp	DATE			NOT NULL,
		Catalog_id	INT,
		Price		DECIMAL			NOT NULL,
		Photo		VARCHAR(255)	NOT NULL,
		Description	VARCHAR(255)	NOT NULL,
		Room_loc	VARCHAR(255)	NOT NULL,
		Creator_name	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (Catalog_id),
		FOREIGN KEY (Room_loc) REFERENCES ROOM(Location),
		FOREIGN KEY (Creator_name) REFERENCES ARTIST(Name)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO WORK VALUES
			('Mona Lisa', 'naturalism', 'Italian Renaissance', '1517-1-1', '1', '1000000000', '322px-Mona_Lisa,_by_Leonardo_da_Vinci,_from_C2RMF_retouched.jpg', 'A painting of Lisa Gherardini', 'Floor 1, South West', 'Leonardo da Vinci'),
			('Freedom From Want','Modernism','New Deal Era','1943-1-1','2','50000','_Freedom_From_Want__-_NARA_-_513539.jpg', 'A painting of optimism', 'Floor 1, South East', 'Norman Rockwell');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_events_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE EVENTS(
		Name		VARCHAR(255)	NOT NULL,
		Timestamp	DATETIME,
		PRIMARY KEY (Timestamp)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO EVENTS VALUES
			('Show da Vinci', '2018-12-08 10:30:00'),
			('Mega Gogh Sale', '2019-02-04 10:30:00'),
			('Rat Modernism', '2021-01-07 12:30:00');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_employee_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE EMPLOYEE(
		SSN			INT,
		Name		VARCHAR(255)	NOT NULL,
		Hourly_wage	DECIMAL			NOT NULL,
		Schedule	VARCHAR(255)	NOT NULL,
		Password	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (SSN)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO EMPLOYEE VALUES
			('123456789', 'Bob of The Bob Family', '30', 'Every weekday', '$2y$10\$rlL8.kEeKujWHvEUkCR6CuPw0M55LVcxtNvCDAZ6nMpSaxXThlC4W'),
			('123456780', 'Bob Jr. of The Bob Family', '25', 'Monday through Thursday', '$2y$10\$thLTE6Lm77zWIbGsUs/lA.xngPd8Xe4Mig5KVzun5CE0HahqmJ4uS'),
			('124444444', 'Buck Buckley', '7', 'Every weekend', '$2y$10\$yo5Yx64mg2.Vyrq8ORNlNeWxOiceThsXUC6YOaqqNOlxTYpkIVYcu'),
			('523496780', 'Don Docent', '25', 'Monday through Thursday', '$2y$10\$lXL/EkUR6tQ8ghwXzRweiePK6yuqiidFLImRB/uTnKaWXHi7.O3he'),
			('724744248', 'Coppo', '10', 'Monday, Wednesday and Friday', '$2y$10\$ucYtkE8j/QWmkLwGb0hsduIfFjCLSzmZtu7ObZAUc3R3OMM7IBDtK'),
			('532084700', 'Sam Security', '12', 'Tuesday, Thursday and Weekends', '$2y$10\$xQMnCYKNukUo8TvyXrRlgOzJu7iMEF2jUtJQpa.wm9/vVa5W/PJne'),
			('835864218', 'William Manager', '20', 'Monday, Wednesday and Sunday', '$2y$10$33mF4pYSYI7FzbTAdkZgYujrHzbU2d1I5WmCo0m3gFc5EMWqTeZgS');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_docent_table() {
	global $db_connection;
	
	//Be Mindful this is simulting a disjoint table.
	$sql = "CREATE TABLE DOCENT(
		SSN	INT PRIMARY KEY REFERENCES EMPLOYEE(SSN),
		Area_Of_Expertise varchar(255),
		Level_Of_Education varchar(255),
		Level_Of_Expertise varchar(255)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO DOCENT (SSN, Area_Of_Expertise, Level_Of_Education) VALUES
			('124444444', 'Romance Art', 'BS'),
			('523496780', 'Modernist Art', 'MA');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_security_table() {
	global $db_connection;
	
	//Be Mindful this is simulting a disjoint table.
	$sql = "CREATE TABLE SECURITY(
		SSN		INT,
		Badge_Clearance INT,
		PRIMARY KEY (SSN),
		FOREIGN KEY (SSN) REFERENCES EMPLOYEE (SSN),
		CONSTRAINT CHK_Badge_clear CHECK (Badge_Clearance>=1 AND Badge_Clearance<=5)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		//Passwords decrypted
		//theLaw
		//security
		$sql = "INSERT INTO SECURITY VALUES
			('724744248', 3),
			('532084700', 5);";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}	
}

function create_manager_table() {
	global $db_connection;
	
	//Be Mindful this is simulting a disjoint table.
	$sql = "CREATE TABLE MANAGER(
		SSN		INT,
		PRIMARY KEY (SSN),
		FOREIGN KEY (SSN) REFERENCES EMPLOYEE(SSN)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO MANAGER VALUES
			('835864218');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}		
}

function create_customer_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE CUSTOMER(
		cid			INT,
		Name		VARCHAR(255)	NOT NULL,
		Email		VARCHAR(255)	NOT NULL,
		Password	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (cid)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO CUSTOMER VALUES
			('1', 'Bill Gates', 'gates@microsoft.net', '$2y$10\$rlL8.kEeKujWHvEUkCR6CuPw0M55LVcxtNvCDAZ6nMpSaxXThlC4W'),
			('2', 'Bob Ross', 'bobross@gmail.com', '$2y$10\$thLTE6Lm77zWIbGsUs/lA.xngPd8Xe4Mig5KVzun5CE0HahqmJ4uS');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_critic_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE CRITIC(
			cid INT,
			Name varchar(255),
			Country varchar(255),
			PRIMARY KEY(cid)
			);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO CRITIC VALUES
			('1','Rat Man', 'France'),
			('2', 'Pixar Disney', 'United Kingdom');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}
}

function create_review_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE REVIEW (
		Title varchar(255),
		Author INT,
		Date_published DATE,
		Body_text varchar(1000),
		PRIMARY KEY (Title, Author),
		FOREIGN KEY (Author) REFERENCES CRITIC(cid)  
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO REVIEW VALUES
			('I Liked This Painting','1', '2020-02-15', 'This painting is so good!!!'),
			('Art is Fun', '2', '2018-07-06','I really like art and this painting is good and reminded me');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}	
}

function create_typical_guests_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE TYPICAL_GUESTS (
		cid			INT,
		Event_time 	DATETIME,
		PRIMARY KEY (cid, Event_time),
		FOREIGN KEY (cid) REFERENCES CUSTOMER(cid),
		FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO TYPICAL_GUESTS VALUES
			('1','2018-12-08 10:30:00'),
			('2', '2019-02-04 10:30:00');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}	
}

function create_educates_about_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE EDUCATES_ABOUT (
		Catalog_id INT,
		SSN INT,
		PRIMARY KEY (Catalog_id, SSN),
		FOREIGN KEY (Catalog_id) REFERENCES WORK(Catalog_id),
		FOREIGN KEY (Ssn) REFERENCES DOCENT(Ssn)
		);";
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO EDUCATES_ABOUT VALUES
			('1','124444444'),
			('2', '523496780');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}	
}

function create_artist_guests_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE ARTIST_GUESTS (
		Artist varchar(255),
		Event_time DATETIME,
		PRIMARY KEY (Artist, Event_Time),
		FOREIGN KEY (Artist) REFERENCES ARTIST(Name),
		FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO ARTIST_GUESTS VALUES
			('Leonardo da Vinci','2018-12-08 10:30:00'),
			('Vincent Van Gogh', '2019-02-04 10:30:00');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}		
}

function create_critic_guests_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE CRITIC_GUESTS (
		cid INT,
		Event_time DATETIME,
		PRIMARY KEY (cid, Event_time),
		FOREIGN KEY (cid) REFERENCES CRITIC(cid),
		FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
		);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO CRITIC_GUESTS VALUES
			('1','2021-01-07 12:30:00');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}		
}

function create_artist_style_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE ARTIST_STYLE (
			Artist varchar(255),
			Style varchar(255),
			PRIMARY KEY (Artist, Style),
			FOREIGN KEY (Artist) REFERENCES ARTIST(Name)
			);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO ARTIST_STYLE VALUES
			('Norman Rockwell','Modernism');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}		
}

function create_works_at_events_table() {
	global $db_connection;
	
	$sql = "CREATE TABLE WORKS_AT_EVENTS (
			Work 		INT,
			Event_time 	DATETIME,
			PRIMARY KEY (Work, Event_time),
			FOREIGN KEY (Work) REFERENCES WORK(Catalog_id),
			FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
			);";
	
	if($db_connection->query($sql)) { //make sure to only add data if table was newly created
		$sql = "INSERT INTO WORKS_AT_EVENTS VALUES
			('1','2018-12-08 10:30:00');";
		if(!$db_connection->query($sql)) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	} else {
		if(strpos($db_connection->error, "already exists") === FALSE) {
			echo "<p>", __FUNCTION__, "() Database Error:", $db_connection->error, "</p>";
		}
	}		
}

?>

