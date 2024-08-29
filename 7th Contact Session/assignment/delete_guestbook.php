<?php
// Database connection
require_once 'conn.php';

// Get guestbook ID from URL
$guestbook_id = $_GET['id'];

// Delete the guestbook
$sql = "DELETE FROM guestbooks WHERE id = $guestbook_id";

// Execute the query
if ($conn->query($sql)) {
    $message = "Data deleted successfully";
    header("Location: index.php?message=" . urlencode($message));
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the database connection
$conn->close();