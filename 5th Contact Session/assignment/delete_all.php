<?php
include('conn.php');

$sql = "DELETE FROM todos";
$conn->query($sql);

header('Location: index.php');
