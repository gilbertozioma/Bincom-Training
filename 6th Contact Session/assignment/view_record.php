<?php
require_once 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance Records</title>
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
    </style>
</head>

<body>

    <h2>View Attendance Records</h2>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="index.php">Back</a>
        </nav>
        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>

                <?php
                // Fetch attendance records
                $sql = "SELECT attendance.attendance_date, students.student_roll_no, students.student_name, attendance.status 
                FROM attendance 
                JOIN students ON attendance.student_id = students.id 
                ORDER BY attendance.attendance_date DESC";

                // Execute the query
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Display each attendance record
                    while ($row = $result->fetch_assoc()) {
                        echo
                        "<tr>
                            <td>{$row['student_roll_no']}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['attendance_date']}</td>
                        </tr>";
                    }
                } else {
                    // Display "No Attendance yet." if no records are found
                    echo
                    "<tr>
                        <td colspan='4'>No attendance yet.</td>
                    </tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </table>
        </div>
    </div>

</body>

</html>