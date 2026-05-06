=====================================================
DRIVEHUB - PREMIUM CAR RENTAL SYSTEM
Lab Submission: Information Management
Student: Christophel Pedroza
School: Cebu Institute of Technology - University
=====================================================

--- PROJECT SETUP ---
1. Extract the "DriveHub" folder into your XAMPP 'htdocs' directory.
2. Open phpMyAdmin (localhost/phpmyadmin).
3. Create a new database named: drivehub_db
4. Import the provided 'drivehub_db.sql' file into the new database.
5. Open your browser and navigate to: http://localhost/DriveHub/login.php

--- TEST CREDENTIALS ---
Email: pedroza@cit.edu
Password: admin123

--- COMPLETED TASKS ---
- Task 1: Secure Login System (Prepared Statements).
- Task 2: Premium Dashboard (index.php) with Session-based greeting.
- Task 3 & 4: Vehicle Registration GUI and Database Insertion logic.
- Task 5: Security Management (Restricted access and Logout functionality).
-Task 6: Project: Edit Profile, Display Record, Add Record, Log off

--- SECURITY FEATURES ---
- The system uses session-based security. If a user tries to access 
  'index.php' or 'add_new_record.php' without logging in, they will 
  be automatically redirected to the login page.
- 'logout.php' properly destroys the session and clears all user data.
=====================================================