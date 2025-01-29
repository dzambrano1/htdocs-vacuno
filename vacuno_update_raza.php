<?php
// local Credentials
// header("Access-Control-Allow-Headers:*");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ganagram";

// Hostinger credentials
// $servername = "localhost";
// $username = "u568157883_root";
// $password = "Sebastian7754*";
// $dbname = "u568157883_ganagram";

// local Credentials
header("Access-Control-Allow-Headers:*");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ganagram";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$raza = isset($_POST['raza']) ? $conn->real_escape_string($_POST['raza']) : '';

if ($id > 0 && !empty($raza)) {
    $sql = "UPDATE vacuno SET raza = '$raza' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Raza actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos proporcionados.']);
}

$conn->close();
?>