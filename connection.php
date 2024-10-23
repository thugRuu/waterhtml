<?php
// Enable error reporting (only for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// RDS Database connection details
$dbhost = "task3-rds.cb9k0usjshhz.us-east-1.rds.amazonaws.com";  // RDS endpoint
$dbuser = "admin";                                                // RDS username
$dbpassword = "adminadmin123";                               // RDS password
$dbname = "water";                                                // Database name

// Create a connection
$con = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// If connected successfully
echo "Connected successfully to the database!";
?>
