<?php
// Global variables
$host = "localhost";
$user = "root";
$password = "";
$database = "smart_healthcare";

// Database connection
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed");
}

echo "Database connected successfully<br>";
?>