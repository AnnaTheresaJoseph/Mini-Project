<?php
$servername = "localhost"; // Assuming WampServer is running on port 8081
$username = "root"; // Replace with your MySQL username
$pass = ""; // Replace with your MySQL password
$dbname = "lostandfound"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
