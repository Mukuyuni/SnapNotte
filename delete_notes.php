<?php
include 'dbb.php'; // Includes the database connection file

// Get the note ID from the POST request
$note_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

// Validate the note ID
if ($note_id > 0) {
    // Prepare a statement to securely delete the note
    $stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->bind_param("i", $note_id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Note deleted successfully!";
    } else {
        echo "Error deleting note: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: Valid note ID is required.";
}

// Close the database connection
$conn->close();
?>
