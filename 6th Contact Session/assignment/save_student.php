<?php
// Database connection
require_once 'conn.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['student_name'];
    $student_roll_no = $_POST['student_roll_no'];

    // Validate inputs
    if (!empty($student_name) && !empty($student_roll_no)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO students (student_name, student_roll_no) VALUES (?, ?)");
        $stmt->bind_param("ss", $student_name, $student_roll_no);

        // Execute and check if successful
        if ($stmt->execute()) {
            echo "New student added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();

// Redirect back to the home page
header("Location: index.php");
