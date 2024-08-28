<?php
// Database connection
require_once 'conn.php';

// Get student ID from URL
$student_id = $_GET['id'];

// Fetch student data
$sql = "SELECT * FROM students WHERE id = $student_id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['student_name'];
    $student_roll_no = $_POST['student_roll_no'];

    // Validate inputs
    if (!empty($student_name) && !empty($student_roll_no)) {
        // Update the student
        $sql = "UPDATE students SET student_name = '$student_name', student_roll_no = '$student_roll_no' WHERE id = $student_id";
        if ($conn->query($sql)) {
            header("Location: index.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            font-family: sans-serif;
            background-color: #0d0d14;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 400px;
            height: auto;
            min-height: 300px;
            padding: 30px;
            border: 2px solid #e6b7eca1;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        nav a {
            padding: 10px 15px;
            background-color: #e6b7eca1;
            color: white;
            text-decoration: none;
            margin-left: 10px;
            transition: .2s ease-in-out;
            ;
        }

        nav a:hover {
            background-color: #6c556ea1;
        }


        h2 {
            color: #bbbbc0;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #bbbbc0;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            color: #fff;
            background-color: #313147;
            box-sizing: border-box;
        }

        input:active,
        input:focus {
            outline: none;
        }

        .btn {
            padding: 10px 15px;
            color: white;
            border: none;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 35px;
            background-color: #e6b7eca1;
            transition: .2s ease-in-out;
        }

        .btn:hover {
            background-color: #6c556ea1;
        }
    </style>
</head>

<body>

    <h2>Edit Student</h2>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="index.php">Back</a>
        </nav>
        <form action="edit_student.php?id=<?php echo $student_id; ?>" method="POST">
            <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" value="<?php echo $student['student_name']; ?>" >
            </div>
            <div class="form-group">
                <label for="student_roll_no">Roll Number</label>
                <input type="text" id="student_roll_no" name="student_roll_no" value="<?php echo $student['student_roll_no']; ?>" >
            </div>
            <button type="submit" class="btn">Update Student</button>
        </form>
    </div>

</body>

</html>