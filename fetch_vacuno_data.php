<?php

require_once '../conexion.php';

// Database connection
$conn = new mysqli('localhost', $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the tagid from the request
if (isset($_GET['tagid'])) {
    $tagid = $_GET['tagid'];

    // Fetch the current data for the specified tagid
    $sql = "SELECT * FROM vacuno WHERE tagid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tagid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}

$conn->close();
?> 