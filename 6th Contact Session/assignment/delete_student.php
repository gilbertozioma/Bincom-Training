<?php
// Database connection
require_once 'conn.php';

// Get student ID from URL
$student_id = $_GET['id'];

// Delete the student
$sql = "DELETE FROM students WHERE id = $student_id";

// Execute the query
if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the database connection
$conn->close();
