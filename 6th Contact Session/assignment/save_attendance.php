<?php
// Database connection
require_once 'conn.php';

// Ensure the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'status' exists in the posted data
    if (isset($_POST['status'])) {

        // Loop through the received status values
        foreach ($_POST['status'] as $student_id => $status) {
            // Check if attendance already exists for today
            $stmt = $conn->prepare("SELECT id FROM attendance WHERE student_id = ? AND attendance_date = CURDATE()");
            $stmt->bind_param("i", $student_id);
            $stmt->execute();
            $stmt->store_result();

            // If record exists, update it
            if ($stmt->num_rows > 0) {
                $stmt = $conn->prepare("UPDATE attendance SET status = ? WHERE student_id = ? AND attendance_date = CURDATE()");
                $stmt->bind_param("si", $status, $student_id);
            } else {
                // If no record exists, insert a new one
                $stmt = $conn->prepare("INSERT INTO attendance (student_id, attendance_date, status) VALUES (?, CURDATE(), ?)");
                $stmt->bind_param("is", $student_id, $status);
            }

            // Execute the statement
            if ($stmt->execute() === FALSE) {
                echo "Error: " . $stmt->error;
            }
        }

        // Close the statement and the connection
        $stmt->close();
        $conn->close();

        // Redirect or inform the user about the successful submission
        header("Location: index.php");
        echo "Attendance saved successfully!";
    } else {
        header("Location: index.php");
        echo "No attendance status provided.";
    }
} else {
    echo "Invalid request method.";
}

