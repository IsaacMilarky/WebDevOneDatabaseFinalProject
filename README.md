# CS 2830 Final Project
## By Isaac Milarsky
Using my database schema from CS 3380 to create a responsive front-end website.
The website is a website that might be used by an art gallery.

# How to Use
	
My web application is an implementation of an art gallery’s website using the database schema that I had to create for my database class.
Moreover the operation of the website is fairly trivial if you keep that in mind. 
	The landing page has a welcome screen and a youtube video on the front of it. The functionality of the website can be seen in the navbar. The navbar separates the functionality of the website into three categories: customer-protected content, staff-protected content and general use content.  The customer-protected content is behind the customer login screen. The customer content allows specific customers to log in and register for events as well as cancel from events using AJAX. The presentation of non-staff-protected content is given higher priority in terms of presentation than staff-protected content. Staff-protected content is behind the staff login and has three tiers: regular employees, docents, and managers. The managers get access to all of the available staff functionality and the test user is registered as a manager. Finally non-protected content includes just viewing the available art that the gallery has, seeing upcoming events and details, and going to the about page. 
	All of these work in tandem to give the full functionality of an art-gallery’s website. Viewing art is available to anybody. Signing up for events is available to registered customers. Manipulating the internal data of the application is available to managers and other staff. To see the full schema of my database look through db_init.php as well as mainRDBMSinitRef.sql which was the reference I used to translate it into a php/mysql program. 
	


# Login Info for all the fake accounts
Test staff account 1:  
SSN: 123456789  
Password: testpassword  

Test staff account 2:  
SSN: 123456780  
Password: anotherpassword  


Test customer account 1:  
cid: 1  
Password: testpassword  

Test customer account 2:  
cid: 2  
Password: anotherpassword  

Test Docent 1:  
SSN: 124444444  
 password: unclebuck  

Test Docent 2:  
SSN: 523496780  
    password: passpass  
    
Test Security account 1:  
SSN: 724744248  
    password: theLaw  

Test Security account 2:  
SSN: 532084700  
    password: security  

Test Manager 1:  
    SSN: 835864218
    Pass: willthebest  
