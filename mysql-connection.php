<?php

echo "Welcome to the stage where we are ready to get connected to a database";


// Connection to the Database
$servername = "localhost";
$username = "root";
$password = "123";
$db_name = "job_board";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Die if connection is not successful
if (!$conn) {
    die("Sorry we failed to connect: ". mysqli_connect_error());
} else {
    echo "Connection was successful";
}
