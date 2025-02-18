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
    $raza = $_POST['raza'] ?? '';
    $grupo = $_POST['grupo'] ?? '';
    $estatus = $_POST['estatus'] ?? '';

    // Validate required fields
    if (empty($tagid) || empty($nombre) || empty($fecha_nacimiento)) {
        throw new Exception("Campos requeridos faltantes");
    }

    // Check if tagid already exists
    $check_stmt = $conn->prepare("SELECT tagid FROM vacuno WHERE tagid = ?");
    $check_stmt->bind_param("s", $tagid);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows > 0) {
        throw new Exception("El Tag ID ya existe en la base de datos");
    }
    $check_stmt->close();

    // Handle image upload if present
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate unique filename
        $fileExtension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        
        // Full path for file storage
        $targetPath = $uploadDir . $newFileName;

        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedTypes)) {
            throw new Exception("Tipo de archivo no permitido");
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
            throw new Exception("Error al subir la imagen");
        }

        // Store the complete path (including uploads/) in the database
        $imagen = 'uploads/' . $newFileName;  // Ensure uploads/ is included
    } else {
        $imagen = null;  // No image uploaded
    }

    // Prepare the insert query
    $sql = "INSERT INTO vacuno (tagid, nombre, fecha_nacimiento, fecha_compra, genero, raza, grupo, estatus, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssssssss", 
        $tagid, 
        $nombre, 
        $fecha_nacimiento, 
        $fecha_compra, 
        $genero, 
        $raza, 
        $grupo, 
        $estatus, 
        $imagen
    );
    
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar el registro: " . $stmt->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Return success response
    echo json_encode([
        "success" => true,
        "message" => "Animal registrado exitosamente"
    ]);

} catch (Exception $e) {
    // Log error to file instead of output
    error_log("Error in vacuno_create.php: " . $e->getMessage());
    
    // Return error response
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?> 