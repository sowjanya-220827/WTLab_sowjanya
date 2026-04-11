<?php
// Global variables (DB credentials)
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "smart_healthcare";
$port = 3306; // Change to 3307 if your MySQL runs on port 3307

// Database connection
$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
