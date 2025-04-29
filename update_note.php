<?php
include 'dbb.php'; // Include databases connection

// Get data from the request
$note_id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

// Validate inputs
if ($note_id && $title && $content) {
    // Securely update the note using prepared statements
    $stmt = $conn->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $note_id);

    if ($stmt->execute()) {
        echo "Note updated successfully!";
    } else {
        echo "Error updating note: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: All fields are required.";
}

$conn->close();
?>
