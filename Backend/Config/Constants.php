<?php
require_once "Extras.php";
// define PHP constants here
define("ACCESS_TOKEN", "TestingToken2024");
define("WEBSITE_URL", "http://127.0.0.1:8080/StudentTeacherPortal/");
define("INC_BACKEND", WEBSITE_URL . "Backend/");
define("RETURN_HOME", "<script>window.location.href='" . WEBSITE_URL . "index.php';</script>");
define("REQUEST_URL", WEBSITE_URL . "Backend/Config/Requests.php");
define("ROUTES_URL", INC_BACKEND . 'Config/Routes.php/');

function show_data()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "teacher_student_portal";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT * FROM students;";
    $result = $conn->query($query);
    $stu_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stu_array[] = $row;
        }
        return $stu_array;
    }
}
