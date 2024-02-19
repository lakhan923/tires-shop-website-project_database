<?php
$hostname = "localhost";
$username = "root";
$password = "database_password";
$database = "project_database";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
