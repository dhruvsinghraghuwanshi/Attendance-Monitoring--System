<?php

// Database configuration
$host = "localhost"; // Change this if your database is hosted elsewhere
$dbname = "student_attendance"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

// Attempt to connect to the database
try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set character set to utf8mb4 (optional, adjust as needed)
    $db->exec("SET NAMES utf8mb4");
} catch(PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}

?>
