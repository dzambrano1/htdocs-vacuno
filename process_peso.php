<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Handle different actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    switch($action) {
        case 'delete':
            handleDelete($conn);
            break;
        case 'update':
            handleUpdate($conn);
            break;
        case 'insert':
            handleInsert($conn);
            break;
        default:
            echo json_encode(['success' => false, 'error' => 'Invalid action']);
            break;
    }
}

function handleDelete($conn) {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM vh_peso WHERE id = '$id'";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

function handleUpdate($conn) {
    $id = $conn->real_escape_string($_POST['id']);
    $peso = $conn->real_escape_string($_POST['peso']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    
    $query = "UPDATE vh_peso SET 
              vh_peso_animal = '$peso',
              vh_peso_precio = '$precio',
              vh_peso_fecha = '$fecha'
              WHERE id = '$id'";
    
    if ($conn->query($query)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

function handleInsert($conn) {
    $tagid = $conn->real_escape_string($_POST['tagid']);
    $peso = $conn->real_escape_string($_POST['peso']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    
    $query = "INSERT INTO vh_peso (vh_peso_tagid, vh_peso_animal, vh_peso_precio, vh_peso_fecha) 
              VALUES ('$tagid', '$peso', '$precio', '$fecha')";
    
    if ($conn->query($query)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

$conn->close();
?> 