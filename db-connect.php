<?php
require_once 'config.php';

session_start();
// Set connection details
//require_once('config.php');
$servername = servername;
$username = username;
$password = password;
$database = database;

// Create connection
$db_connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}

?>
<div class="test-messeges"><?php // echo "Connected successfully"; ?></div>