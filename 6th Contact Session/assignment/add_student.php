<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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
    <h2>Add Student</h2>

    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="index.php">Back</a>
        </nav>

        <!-- Form -->
        <form action="save_student.php" method="POST">
            <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" required>
            </div>
            <div class="form-group">
                <label for="student_roll_no">Roll Number</label>
                <input type="number" id="student_roll_no" name="student_roll_no" required>
            </div>
            <button type="submit" class="btn">Add Student</button>
        </form>
    </div>

</body>

</html>