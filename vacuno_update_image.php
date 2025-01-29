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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
    exit();
}

// Check if file and id are set
if (!isset($_FILES['image']) || !isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para procesar la solicitud.']);
    exit();
}

$id = intval($_POST['id']);
$imagen = $_FILES['image'];

// Validate the animal ID
$sql = "SELECT image FROM vacuno WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Animal no encontrado.']);
    $stmt->close();
    $conn->close();
    exit();
}

$stmt->bind_result($currentImagePath);
$stmt->fetch();
$stmt->close();

// Handle the uploaded file
$targetDir = "uploads/"; // Directory to store uploaded images
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$originalFilename = basename($imagen["name"]);
$imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

// Generate a unique filename to prevent overwriting
$newFilename = "animal_" . $id . "_" . time() . "." . $imageFileType;
$targetFilePath = $targetDir . $newFilename;

// Check if the file is a real image
$check = getimagesize($imagen["tmp_name"]);
if ($check === false) {
    echo json_encode(['success' => false, 'message' => 'El archivo no es una imagen válida.']);
    $conn->close();
    exit();
}

// Allow only certain file formats
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageFileType, $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Solo se permiten archivos JPG, JPEG, PNG y GIF.']);
    $conn->close();
    exit();
}

// Check file size (already handled in JS, but double-check)
$maxSize = 2 * 1024 * 1024; // 2MB
if ($imagen["size"] > $maxSize) {
    echo json_encode(['success' => false, 'message' => 'El archivo excede el tamaño máximo permitido de 2MB.']);
    $conn->close();
    exit();
}

// Attempt to move the uploaded file
if (!move_uploaded_file($imagen["tmp_name"], $targetFilePath)) {
    echo json_encode(['success' => false, 'message' => 'Error al subir el archivo.']);
    $conn->close();
    exit();
}

// Optionally, delete the old image file if it exists and is not a default image
if (!empty($currentImagePath) && file_exists($currentImagePath)) {
    // Prevent deletion of default images by checking if the path is not the default
    if ($currentImagePath !== './images/default_image.png') {
        unlink($currentImagePath);
    }
}

// Update the database with the new image path
$updateSql = "UPDATE vacuno SET image = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("si", $targetFilePath, $id);

if ($updateStmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Imagen actualizada correctamente.', 'image_path' => $targetFilePath]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos: ' . $conn->error]);
}

$updateStmt->close();
$conn->close();
?>