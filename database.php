<?php
// MovieHub database connection.
// XAMPP default MySQL settings are usually:
// host = localhost, user = root, password = "", database = moviehub

$host = "localhost";
$username = "root";
$password = "";
$database = "moviehub";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . htmlspecialchars($conn->connect_error));
}

$conn->set_charset("utf8mb4");
?>
