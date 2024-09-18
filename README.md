Install 
Apache, MySQL and PHP v8.1

Run These MySQL Queries to create the database:

1-> CREATE DATABASE teacher_student_portal; OR Do it manualy from any MySQL IDE


2-> Export the SQL file from path:
  Backend/Config/teacher_student_portal.sql

3-> Updated your server details:
  Backend/Config/Database.php
    private $db_host = "your localhost";
    private $db_name = "your database name";
    private $db_user = "database user";
    private $db_pass = " database password";

Now the project is ready to Run!
on your browser open: your_localhost/StudentTeacherPortal/index.php
