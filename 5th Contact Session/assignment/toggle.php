<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $completed = isset($_POST['completed']) ? 1 : 0;

    $sql = "UPDATE todos SET completed = $completed WHERE id = $id";
    $conn->query($sql);
}

header('Location: index.php');
