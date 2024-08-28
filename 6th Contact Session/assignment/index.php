<?php
require_once 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Register</title>
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

        h2 {
            color: #bbbbc0;
            text-align: center;
            margin-bottom: 20px;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        nav a {
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            margin-left: 10px;
            background-color: #e6b7eca1;
            transition: .2s ease-in-out;
        }

        nav a:hover {
            background-color: #6c556ea1;
        }

        a {
            text-decoration: none;
        }

        .table-wrapper {
            max-height: 300px;
            overflow-y: auto;
            width: 100%;
            scrollbar-width: thin;
            scrollbar-color: #6c556ea1 #0d0d14;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #e6b7eca1;
            color: #fff;
        }

        th,
        td {
            border: 1px solid #e6b7eca1;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #0d0d14;
            position: sticky;
            top: 0;
        }

        td {
            vertical-align: top;
            padding: 20px;
            height: auto;
            text-align: center;
        }

        input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #e6b7eca1;
        }

        input[type="radio"]:checked {
            background-color: #e6b7eca1;
        }


        .btn {
            padding: 10px 15px;
            background-color: #e6b7eca1;
            color: white;
            border: none;
            cursor: pointer;
            transition: .2s ease-in-out;
        }

        .btn:hover {
            background-color: #6c556ea1;
        }
    </style>
</head>

<body>
    <h2>Student Attendance Register</h2>

    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="view_record.php">View Record</a>
            <a href="add_student.php">Add Student</a>
        </nav>

        <form action="save_attendance.php" method="POST">
            <div class="table-wrapper">
                <table>
                    <tr>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Mark Attendance</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    // Fetch students and their attendance records from the database
                    $sql = "SELECT students.id AS student_id, students.student_roll_no, students.student_name, 
                        (SELECT status FROM attendance WHERE student_id = students.id ORDER BY attendance_date DESC LIMIT 1) AS last_status,
                        (SELECT attendance_date FROM attendance WHERE student_id = students.id ORDER BY attendance_date DESC LIMIT 1) AS last_attendance_date
                        FROM students";
                    $result = $conn->query($sql);

                    // Display the table if there are records
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Display the last attendance status and date
                            $lastStatus = $row['last_status'] ?? 'Not Recorded';
                            $lastAttendanceDate = $row['last_attendance_date'] ?? 'N/A';

                            echo "<tr>
                            <td>{$row['student_roll_no']}</td>
                            <td>{$row['student_name']}</td>
                            <td>
                                <input type='radio' name='status[{$row['student_id']}]' value='Present' " . ($lastStatus == 'Present' ? 'checked' : '') . "> Present
                                <input type='radio' name='status[{$row['student_id']}]' value='Absent' " . ($lastStatus == 'Absent' ? 'checked' : '') . "> Absent
                            </td>
                            <td>
                                <a href='edit_student.php?id={$row['student_id']}' class='btn'>Edit</a>
                                <a href='delete_student.php?id={$row['student_id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                            </td>
                        </tr>";
                        }
                    } else {
                        // Display if no students are found
                        echo
                        "<tr>
                        <td colspan='4'>No student yet.</td>
                    </tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </table>
            </div>
            <button type="submit" class="btn">Save Attendance</button>
        </form>
    </div>

</body>

</html>