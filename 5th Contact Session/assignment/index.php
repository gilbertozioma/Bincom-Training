<?php
include('conn.php');

// Handle form submission for adding a task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO todos (task) VALUES ('$task')";
    $conn->query($sql);
}

// Fetch all tasks
$sql = "SELECT * FROM todos ORDER BY id ASC";
$result = $conn->query($sql);

// Get filter status from URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO LIST</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <h1>Todo List</h1>
        <div class="input-container">
            <form class="todo-form" method="POST" action="">
                <input class="todo-input" name="task" placeholder="Add a new task..." required>
                <button type="submit" class="add-button">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </form>
        </div>
        <div class="filters">
            <div class="filter" data-filter="all"><a href="?filter=all">All</a></div>
            <div class="filter" data-filter="completed"><a href="?filter=completed">Complete</a></div>
            <div class="filter" data-filter="pending"><a href="?filter=pending">Incomplete</a></div>
            <div class="delete-all"><a href="delete_all.php">Delete All</a></div>
        </div>
        <div class="todos-container">
            <ul class="todos">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php 
                            // Apply filter logic
                            if ($filter == 'all' || 
                                ($filter == 'completed' && $row['completed']) || 
                                ($filter == 'pending' && !$row['completed'])
                            ): 
                        ?>
                        <li class="todo">
                            <form class="check-form" method="POST" action="toggle.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <label>
                                    <input type="checkbox" name="completed" <?= $row['completed'] ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <span class="<?= $row['completed'] ? 'completed' : '' ?>"><?= htmlspecialchars($row['task']) ?></span>
                                </label>
                            </form>
                            <form method="POST" action="delete.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="delete-btn"><i class="fa fa-times"></i></button>
                            </form>
                        </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="empty-text">No tasks yet.</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>

</html>
