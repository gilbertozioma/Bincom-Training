<?php
require_once 'conn.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update attendance record
    $sql = "UPDATE attendance SET status = '$status' WHERE id = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

    header("Location: index.php");
}
