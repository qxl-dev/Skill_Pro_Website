SkillPro Institute – Web Application

Overview

The SkillPro Institute web application is a multi-role platform designed to manage vocational training programs.
It includes distinct dashboards for Admins, Instructors, and Students, enabling course management, registration, scheduling, and communication in a single interactive system.

NOTE !!!! - THERE ARE TWO DATABASE FILES IN THIS SORCE CODE FILES 

schema.sql - THIS IS THE MAIN DATABASE FILE WHICH CONTAINES ALL BASIC TABLES AND DATA
skillpro.sql - THIS IS A EXPORTED SQL SCEMA FROM PHP MY ADMIN AFTER DOING SOME CHANGES TO THE DATABASE 

WHEN RUNING THE APPLICATION MAKE SURE TO IMPORT BOTH FILES TO ONE DATABASE CALLED spdb.sql

THIS IS VERY IMPORTANT OTHERWISE WEBSITE WONT FUNCTION PROPERLY !!!!!!


Features

•	Role-based authentication (Admin, Instructor, Student)
•	Secure login and registration using SHA-256 password hashing
•	Admin Dashboard – manage users, courses, schedules, notices, and inquiries
•	Instructor Dashboard – view assigned courses and student enrollments
•	Student Dashboard – register for courses and view active enrollments
•	Search & Filter System for courses by category or title
•	Dynamic Calendar & Notice Board
•	Secure database interaction using prepared SQL statements

Technologies Used

•	Frontend: HTML5, CSS3, JavaScript, Bootstrap
•	Backend: PHP 8+
•	Database: MySQL
•	Server Environment: XAMPP / Apache
•	Styling Frameworks: Custom CSS, Flexbox, Grid Layout

Setup Instructions

1.	Install XAMPP or any local PHP server and ensure Apache & MySQL are running.
2.	Copy the folder 'skill_pro_v2' to your XAMPP htdocs directory (e.g., C:\xampp\htdocs\skill_pro_v2).
3.	Open phpMyAdmin and create a new database named 'skillpro'.
4.	Import the provided 'schema.sql' file located in the project root to set up tables and sample data.
5.	Verify the database connection in config/db.php and run http://localhost/skill_pro_v2/ in your browser.
6. 




Sample Login Credentials

Role	Email	Password
Admin	admin@skillpro.lk	admin123
Instructor	sanduni@skillpro.lk	pass123
Student	nadeesha@skillpro.lk	123456

Notes
•	Do not register Admin accounts through the form — only admin@skillpro.lk has admin privileges.
•	Students and instructors can register through register.php.
•	Use logout before switching roles to avoid session conflicts.
•	If styles don’t load, ensure theme.css path is correct and clear browser cache.

