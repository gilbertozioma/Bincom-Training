<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM todos WHERE id = $id";
    $conn->query($sql);
}

header('Location: index.php');
