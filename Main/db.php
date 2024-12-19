<?php
// Database configuration
$host = 'localhost'; // Change if your database host is different
$username = 'root';  // Replace with your database username
$password = '';      // Replace with your database password
$database = 'gaming_arena'; // Replace with your database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Optional: Uncomment the line below for debugging connection success
// echo "Database connected successfully!";
?>
