<?php
// Database configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'omni';

// Establishing a connection to the database
$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
