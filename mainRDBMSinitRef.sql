CREATE TABLE ART_GALLERY(
		Name		VARCHAR(255)	NOT NULL,
		Hours		VARCHAR(255)	NOT NULL,
		Address	VARCHAR(255),
		PRIMARY KEY (Address)
		);

CREATE TABLE ROOM(
		Theme		VARCHAR(255)	NOT NULL,
		Location	VARCHAR(255),
		Gal_addr	VARCHAR(255),
		PRIMARY KEY (Location),
		FOREIGN KEY (Gal_addr) REFERENCES ART_GALLERY(Address)
		);

/*Parent table class*/
/* Turns out MySQL doesn't support table inheritance. So, We make primary keys inherit parent from subclass*/
CREATE TABLE EMPLOYEE(
		SSN		VARCHAR(255),
		Name		VARCHAR(255)	NOT NULL,
		Hourly_wage	VARCHAR(255)	NOT NULL,
		Schedule	VARCHAR(255)	NOT NULL,
		Gal_addr	VARCHAR(255),
		Password	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (SSN),
		FOREIGN KEY (Gal_addr) REFERENCES ART_GALLERY(Address)
		);

/*Children of EMPLOYEE */
CREATE TABLE DOCENT(
		SSN	VARCHAR(255) PRIMARY KEY REFERENCES EMPLOYEE(SSN),
		Area_Of_Expertise varchar(255),
		Level_Of_Education varchar(255),
		Level_Of_Expertise varchar(255)
		);

CREATE TABLE SECURITY(
		SSN		VARCHAR(255) PRIMARY KEY REFERENCES EMPLOYEE(SSN),
		Badge_Clearance INT,
		CONSTRAINT CHK_Badge_clear CHECK (Badge_clearance>=1 AND Badge_Clearance<=5)
		);

CREATE TABLE MANAGER(
		SSN		VARCHAR(255) PRIMARY KEY REFERENCES EMPLOYEE(SSN),
		Gal_addr	VARCHAR(255),
		FOREIGN KEY (Gal_addr) REFERENCES ART_GALLERY(Address)
		);

CREATE TABLE EVENTS(
		Name		VARCHAR(255)	NOT NULL,
		Timestamp	DATETIME,
		Gal_addr	VARCHAR(255),
		PRIMARY KEY (Timestamp),
		FOREIGN KEY (Gal_addr) REFERENCES ART_GALLERY(Address)
		);

CREATE TABLE ARTIST(
		Name		VARCHAR(255),
		Country	VARCHAR(255)	NOT NULL,
		Date_of_birth	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (Name)
		);

CREATE TABLE WORK(
		Name		VARCHAR(255)	NOT NULL,
		Style		VARCHAR(255)	NOT NULL,
		Period		VARCHAR(255)	NOT NULL,
		Timestamp	VARCHAR(255)	NOT NULL,
		Catalog_id	VARCHAR(255),
		Price		VARCHAR(255)	NOT NULL,
		Photo		VARCHAR(255)	NOT NULL,
		Description	VARCHAR(255)	NOT NULL,
		Room_loc	VARCHAR(255)	NOT NULL,
		Creator_name	VARCHAR(255)	NOT NULL,
		PRIMARY KEY (Catalog_id),
		FOREIGN KEY (Room_loc) REFERENCES ROOM(Location),
		FOREIGN KEY (Creator_name) REFERENCES ARTIST(Name)
		);

CREATE TABLE CUSTOMER(
		cid		VARCHAR(255),
		Name		VARCHAR(255)	NOT NULL,
		Email		VARCHAR(255)	NOT NULL,
		Password	VARCHAR(255)	NOT NULL,
		Gal_addr	VARCHAR(255),
		PRIMARY KEY (cid),
		FOREIGN KEY (Gal_addr) REFERENCES ART_GALLERY(Address)
		);

CREATE TABLE CRITIC(
			cid INT,
			Name varchar(255),
			Country varchar(255),
			PRIMARY KEY(cid)
			);

CREATE TABLE REVIEW (
		Title varchar(255),
		Author INT,
		Date_published DATE,
		Body_text varchar(255),

		FOREIGN KEY (Author) REFERENCES CRITIC(cid)  
		);

CREATE TABLE TYPICAL_GUESTS (
		cid VARCHAR(255) UNIQUE,
		Event_time DATETIME UNIQUE,
		FOREIGN KEY (cid) REFERENCES CUSTOMER(cid),
		FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp) 
		);

/* Here be dragons */
/* These references subclasses of Employee so be careful */
CREATE TABLE EDUCATES_ABOUT (
		Catalog_id VARCHAR(255) UNIQUE,
		Ssn VARCHAR(255) UNIQUE,
		FOREIGN KEY (Catalog_id) REFERENCES WORK(Catalog_id),
		FOREIGN KEY (Ssn) REFERENCES DOCENT(Ssn)
		);

CREATE TABLE ARTIST_GUESTS (
		Artist varchar(255),
		Event_time DATETIME,
		FOREIGN KEY (Artist) REFERENCES ARTIST(Name),
		FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
		);

CREATE TABLE CRITIC_GUESTS (
		Event_Time DATETIME,
		cid INT,
		FOREIGN KEY (Event_Time) REFERENCES EVENTS(Timestamp),
		FOREIGN KEY (cid) REFERENCES CRITIC(cid)
		);

CREATE TABLE ARTIST_STYLE (
	Artist varchar(255),
	Style varchar(255),
	FOREIGN KEY (Artist) REFERENCES ARTIST(Name)
);

CREATE TABLE WORKS_AT_EVENTS (
	Work Int,
	Event_Time DATE,
	FOREIGN KEY (Work) REFERENCES WORK(Catalog_id),
	FOREIGN KEY (Event_time) REFERENCES EVENTS(Timestamp)
);