<?php
// update_new_animal.php

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
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit();
}

// Function to sanitize input data
function sanitize_input($data, $conn) {
    return htmlspecialchars(trim($conn->real_escape_string($data)));
}

// Initialize an array to store errors
$errors = [];

// Sanitize and retrieve form inputs
$nombre = isset($_POST['nombre']) ? sanitize_input($_POST['nombre'], $conn) : '';
$genero = isset($_POST['genero']) ? sanitize_input($_POST['genero'], $conn) : '';
$estatus = isset($_POST['estatus']) ? sanitize_input($_POST['estatus'], $conn) : '';
$tagid = isset($_POST['tagid']) ? sanitize_input($_POST['tagid'], $conn) : '';
$raza = isset($_POST['raza']) ? sanitize_input($_POST['raza'], $conn) : '';
$grupo = isset($_POST['grupo']) ? sanitize_input($_POST['grupo'], $conn) : '';
$nacimiento = isset($_POST['fecha_nacimiento']) ? sanitize_input($_POST['fecha_nacimiento'], $conn) : '';
$compra = isset($_POST['fecha_compra']) ? sanitize_input($_POST['fecha_compra'], $conn) : '';

// Validate required fields
if (empty($nombre)) {
    $errors[] = 'El campo Nombre es obligatorio.';
}

if (empty($genero)) {
    $errors[] = 'El campo Genero es obligatorio.';
} elseif (!in_array($genero, ['Macho', 'Hembra'])) {
    $errors[] = 'Sexo inválido.';
}

if (empty($estatus)) {
    $errors[] = 'El campo Estatus es obligatorio.';
}

if (empty($tagid)) {
    $errors[] = 'El campo Tag ID es obligatorio.';
}

if (empty($raza)) {
    $errors[] = 'El campo Raza es obligatorio.';
}

if (empty($grupo)) {
    $errors[] = 'El campo Grupo es obligatorio.';
}

if (empty($nacimiento)) {
    $errors[] = 'El campo Fecha Nacimiento es obligatorio.';
}

if (empty($compra)) {
    $compra = $nacimiento;
}

// Handle image upload
$imagen_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $image = $_FILES['image'];

    // Check for upload errors
    if ($image['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error al subir la imagen.';
    } else {
        // Validate file type
        if (!in_array($image['type'], $allowed_types)) {
            $errors[] = 'Tipo de archivo de imagen no permitido. Permisos: JPG, PNG, GIF.';
        }

        // Validate file size
        if ($image['size'] > $max_size) {
            $errors[] = 'El tamaño de la imagen excede el límite de 2MB.';
        }

        // If no errors, proceed to upload
        if (empty($errors)) {
            // Define the upload directory
            $upload_dir = 'uploads/'; // Ensure this directory exists and is writable

            // Create the upload directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate a unique filename to prevent overwriting
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $unique_name = uniqid('img_', true) . '.' . $file_extension;
            $target_path = $upload_dir . $unique_name;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($image['tmp_name'], $target_path)) {
                $imagen_path = $target_path;
            } else {
                $errors[] = 'Error al mover la imagen subida.';
            }
        }
    }
}

// If there are any errors, return them
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors)
    ]);
    $conn->close();
    exit();
}

// Prepare the INSERT statement using prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO vacuno (nombre, genero, estatus, tagid, raza, grupo, fecha_nacimiento, fecha_compra, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la preparación de la consulta: ' . $conn->error
    ]);
    $conn->close();
    exit();
}

// Bind the parameters to the statement
$stmt->bind_param("sssssssss", $nombre, $genero, $estatus, $tagid, $raza, $grupo, $nacimiento, $compra, $imagen_path);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Nuevo animal agregado exitosamente.'
    ]);
} else {
    // If there's an error during execution, return it
    echo json_encode([
        'success' => false,
        'message' => 'Error al insertar el nuevo animal: ' . $stmt->error
    ]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?> 