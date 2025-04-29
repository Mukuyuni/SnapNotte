<?php
$servername = "localhost"; // The Server name for local development
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password (XAMPP is always empty)
$dbname = "snapnote_db"; // Name of the database you created

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


