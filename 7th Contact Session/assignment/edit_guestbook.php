<?php
// Database connection
require_once 'conn.php';

// Get guestbook ID from URL
$guestbook_id = $_GET['id'];

// Fetch guestbook data
$sql = "SELECT * FROM guestbooks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guestbook_id);
$stmt->execute();
$result = $stmt->get_result();
$guestbook = $result->fetch_assoc();
$stmt->close();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guestbook_id = $_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $message = $conn->real_escape_string($_POST['message']);

    // Update the guestbook
    $sql = "UPDATE guestbooks SET name = ?, message = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $message, $guestbook_id);

    // Execute the query
    if ($stmt->execute() === TRUE) {
        $message = "Data updated successfully";
        header("Location: index.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guestbook Entry</title>
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
            margin-top: 10px;
            margin-bottom: 5px;
            color: #bbbbc0;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            color: #fff;
            background-color: #313147;
            box-sizing: border-box;
        }

        input,
        textarea:active,
        input,
        textarea:focus {
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

    <h2>Edit Guestbook Entry</h2>
    <div class="container">
        <!-- Navigation -->
        <nav>
            <a href="index.php">Back</a>
        </nav>

        <!-- Form -->
        <form action="edit_guestbook.php?id=<?php echo $guestbook_id; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $guestbook['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($guestbook['name']); ?>" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required><?php echo htmlspecialchars($guestbook['message']); ?></textarea>

            <button type="submit" class="btn">Update</button>
        </form>
    </div>

</body>

</html>