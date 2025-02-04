<?php
require_once '../conexion.php';

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
    $query = "DELETE FROM vh_leche WHERE id = '$id'";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

function handleUpdate($conn) {
    try {
        $id = $conn->real_escape_string($_POST['id']);
        $litros = $conn->real_escape_string($_POST['litros']);
        $precio = $conn->real_escape_string($_POST['precio']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($litros) || !is_numeric($precio)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "UPDATE vh_leche SET 
                  vh_leche_litros = '$litros',
                  vh_leche_precio = '$precio',
                  vh_leche_fecha = '$fecha'
                  WHERE id = '$id'";
        
        if ($conn->query($query)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

function handleInsert($conn) {
    try {
        $tagid = $conn->real_escape_string($_POST['tagid']);
        $litros = $conn->real_escape_string($_POST['litros']);
        $precio = $conn->real_escape_string($_POST['precio']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($litros) || !is_numeric($precio)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "INSERT INTO vh_leche (vh_leche_tagid, vh_leche_litros, vh_leche_precio, vh_leche_fecha) 
                  VALUES ('$tagid', '$litros', '$precio', '$fecha')";
        
        if ($conn->query($query)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

// Add validation function
function validateInput($value, $type) {
    switch($type) {
        case 'numeric':
            return is_numeric($value) && $value >= 0;
        case 'date':
            return strtotime($value) !== false;
        default:
            return false;
    }
}

$conn->close();
?> 