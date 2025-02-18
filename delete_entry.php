<?php

require_once '../conexion.php';

// Database connection
$conn = new mysqli('localhost', $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the POST request
$id = intval($_POST['id']);

// Prepare and execute the delete statement
$sql = "DELETE FROM alimentacion WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();
?> 