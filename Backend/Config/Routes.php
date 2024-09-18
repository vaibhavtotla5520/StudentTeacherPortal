<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "Constants.php";
require_once "../Controllers/HomeController.php";

$Home = new HomeController;

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// die($uri_path);
$uri_segments = explode('/', $uri_path);

$Route = end($uri_segments);

switch ($Route) {
    case "login":
        $Home->login($_POST);
        break;
    case "register":
        $Home->register($_POST);
        break;
    case "logout":
        $Home->logout($_SESSION['id']);
        break;
    case "AddStudent":
        $Home->AddStudent($_POST);
        break;
    case "EditStudent":
        $Home->EditStudent($_POST);
        break;
    case "DeleteStudent":
        $Home->deleteStudent($_GET);
        break;
    default:
        echo RETURN_HOME;
        break;
}
