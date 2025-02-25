<?php
require_once '../conexion.php';
// Disable error reporting in output
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json');

try {
    
    $conn = new mysqli($hostname, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $tagid = $_POST['tagid'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $fecha_compra = $_POST['fecha_compra'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $etapa = $_POST['etapa'] ?? '';
    $raza = $_POST['raza'] ?? '';
    $grupo = $_POST['grupo'] ?? '';
    $estatus = $_POST['estatus'] ?? '';

    // Validate required fields
    if (empty($tagid) || empty($nombre) || empty($fecha_nacimiento)) {
        throw new Exception("Campos requeridos faltantes");
    }

    // Handle image upload if present
    $imagen = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate unique filename
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imagen = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetPath = $uploadDir . $imagen;

        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedTypes)) {
            throw new Exception("Tipo de archivo no permitido");
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            throw new Exception("Error al subir la imagen");
        }

        // Store the path including uploads directory in the database
        $imagen = 'uploads/' . $imagen; // Include uploads/ in the stored path
    }

    // Prepare the update query
    $sql = "UPDATE vacuno SET 
            nombre = ?, 
            fecha_nacimiento = ?, 
            fecha_compra = ?,
            genero = ?,
            raza = ?,
            etapa = ?,
            grupo = ?,
            estatus = ?";
    
    $params = [$nombre, $fecha_nacimiento, $fecha_compra, $genero, $raza, $etapa, $grupo, $estatus];
    $types = "ssssssss";
    
    if ($imagen) {
        $sql .= ", image = ?";
        $params[] = $imagen;
        $types .= "s";
    }
    
    $sql .= " WHERE tagid = ?";
    $params[] = $tagid;
    $types .= "s";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    
    if (!$stmt->execute()) {
        throw new Exception("Error al actualizar el registro: " . $stmt->error);
    }

    if ($stmt->affected_rows === 0) {
        throw new Exception("No se realizaron cambios en el registro");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Return success response
    echo json_encode([
        "success" => true,
        "message" => "Registro actualizado exitosamente"
    ]);

} catch (Exception $e) {
    // Log error to file instead of output
    error_log("Error in vacuno_update.php: " . $e->getMessage());
    
    // Return error response
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>
