<?php
require_once 'config.php';

session_start();
// Set connection details
//require_once('config.php');
$servername = SERVER_NAME;
$username = USERNAME;
$password = PASSWORD;
$database = DATABASE;

// Create connection
$db_connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}
