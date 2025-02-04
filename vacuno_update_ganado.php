<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw POST data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate received data
if (!isset($data['id'], $data['raza'], $data['clasificacion'], $data['estatus'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit();
}

$id = intval($data['id']);
$raza = $conn->real_escape_string($data['raza']);
$clasificacion = $conn->real_escape_string($data['clasificacion']);
$estatus = $conn->real_escape_string($data['estatus']);

// Prepare and bind the SQL statement
$stmt = $conn->prepare("UPDATE vacuno SET raza = ?, clasificacion = ?, estatus = ? WHERE id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sssi", $raza, $clasificacion, $estatus, $id);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?> 