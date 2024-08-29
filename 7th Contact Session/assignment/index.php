<?php
include 'conn.php';
// Check if a message is passed in the URL
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    echo "<script>alert('$message');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            font-family: sans-serif;
            color: #fff;
            background-color: #0d0d14;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            color: #bbbbc0;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
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

        .table-wrapper {
            max-height: 300px;
            min-width: 600px;
            max-width: 800px;
            overflow-y: auto;
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
    <h2>Guestbook</h1>

        <div class="container">
            <nav>
                <a href="create_guestbook.php">Add New Entry</a>
            </nav>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM guestbooks ORDER BY id ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <a href="edit_guestbook.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                                        <a href="delete_guestbook.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">No entries found.</td>
                            </tr>
                        <?php }
                        $conn->close();
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
</body>

</html>
