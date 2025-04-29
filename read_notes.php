<?php
include 'dbb.php'; // Include database connection

$user_id = 1; // Example user ID for.

$sql = "SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);

// Start output
if ($result->num_rows > 0) {
    // Loop through and output each note
    while ($row = $result->fetch_assoc()) {
        echo "<div class='note'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        echo "<span class='timestamp'>Created on: " . $row['created_at'] . "</span>";
        // Include Edit and Delete buttons
        echo "<button class='edit-button' data-id='" . $row['id'] . "' data-title='" . htmlspecialchars($row['title']) . "' data-content='" . htmlspecialchars($row['content']) . "'>Edit</button>";
        echo "<button class='delete-button' data-id='" . $row['id'] . "'>Delete</button>";
        echo "</div>";
    }
} else {
    echo "<p>No notes found!</p>";
}

$conn->close(); // Close the database connection
?>
