<?php
// this includes the database connection file
include 'dbb.php'; // Ensures dbb.php is correctly configured

// Getting the data submitted via POST request
$title = isset($_POST['title']) ? $_POST['title'] : null;
$content = isset($_POST['content']) ? $_POST['content'] : null;
$user_id = 1; 

// Check if the form data is valid
if ($title && $content) {
    // Use prepared statements to insert data securely
    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content); // "i" for integer, "s" for strings

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Note added successfully!"; 
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Error: Title and content are required.";
}

// Close the database connection
$conn->close();
?>
