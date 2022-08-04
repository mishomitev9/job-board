<?php

// Connection to the Database
$servername = "localhost";
$username = "root";
$server_password = "123";
$db_name = "job_board";

// Create a connection
$conn = new mysqli($servername, $username, $server_password, $db_name);

// Die if connection is not successful
if (!$conn) {
    die(mysqli_error($conn));
}

 //Close connection
//mysqli_close($conn);
