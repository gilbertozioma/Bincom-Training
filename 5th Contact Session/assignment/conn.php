<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bincom_training_todo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}