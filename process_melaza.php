<?php
require_once '../conexion.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Debug incoming request
error_log('Request Method: ' . $_SERVER['REQUEST_METHOD']);
error_log('POST Data: ' . print_r($_POST, true));

// Handle different actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    error_log('Action: ' . $action); // Debug log
    
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
            error_log('Invalid action: ' . $action); // Debug log
            echo json_encode(['success' => false, 'error' => 'Invalid action: ' . $action]);
            break;
    }
}

function handleDelete($conn) {
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM vh_melaza WHERE id = '$id'";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

function handleUpdate($conn) {
    try {
        $id = $conn->real_escape_string($_POST['id']);
        $tagid = $conn->real_escape_string($_POST['tagid']);
        $racion = $conn->real_escape_string($_POST['racion']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $etapa = $conn->real_escape_string($_POST['etapa']);
        $producto = $conn->real_escape_string($_POST['producto']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($racion) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "UPDATE vh_melaza SET 
                  vh_melaza_tagid = '$tagid',
                  vh_melaza_racion = '$racion',
                  vh_melaza_costo = '$costo',
                  vh_melaza_etapa = '$etapa',
                  vh_melaza_producto = '$producto',
                  vh_melaza_fecha = '$fecha'
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
        $racion = $conn->real_escape_string($_POST['racion']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $etapa = $conn->real_escape_string($_POST['etapa']);
        $producto = $conn->real_escape_string($_POST['producto']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($racion) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "INSERT INTO vh_melaza 
                  (vh_melaza_tagid, vh_melaza_racion, vh_melaza_costo, 
                   vh_melaza_etapa, vh_melaza_producto, vh_melaza_fecha) 
                  VALUES 
                  ('$tagid', '$racion', '$costo', '$etapa', '$producto', '$fecha')";
        
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