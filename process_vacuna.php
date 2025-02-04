<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

$conn = new mysqli($servername, $username, $password, $dbname);

// Handle DELETE requests
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $conn->real_escape_string($_POST['id']);
    
    $query = "DELETE FROM vh_aftosa WHERE vh_aftosa_id = '$id'";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

// Handle INSERT requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    $tagid = $conn->real_escape_string($_POST['tagid']);
    $producto = $conn->real_escape_string($_POST['producto']);
    $costo = $conn->real_escape_string($_POST['costo']);
    $dosis = $conn->real_escape_string($_POST['dosis']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    
    $query = "INSERT INTO vh_aftosa (vh_aftosa_tagid, vh_aftosa_producto, vh_aftosa_costo, vh_aftosa_dosis, vh_aftosa_fecha) 
              VALUES ('$tagid', '$producto', '$costo', '$dosis', '$fecha')";
    
    if ($conn->query($query)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

$conn->close();
?> 