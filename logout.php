<?php
 require_once('db-connect.php');

if (isset($_SESSION['login'])) {
    session_destroy();
    header('location: index.php');
}
