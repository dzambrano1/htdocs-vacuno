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
    $query = "DELETE FROM vh_lombrices WHERE id = '$id'";
    
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
        $dosis = $conn->real_escape_string($_POST['dosis']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $producto = $conn->real_escape_string($_POST['producto']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($dosis) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "UPDATE vh_lombrices SET 
                  vh_lombrices_tagid = '$tagid',
                  vh_lombrices_producto = '$producto',
                  vh_lombrices_dosis = '$dosis',
                  vh_lombrices_costo = '$costo',                  
                  vh_lombrices_fecha = '$fecha'
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
        $producto = $conn->real_escape_string($_POST['producto']);
        $dosis = $conn->real_escape_string($_POST['dosis']);
        $costo = $conn->real_escape_string($_POST['costo']);        
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($dosis) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "INSERT INTO vh_lombrices 
                  (vh_lombrices_tagid, vh_lombrices_producto, vh_lombrices_dosis, vh_lombrices_costo, 
                    vh_lombrices_fecha) 
                  VALUES 
                  ('$tagid', '$producto', '$dosis', '$costo',  '$fecha')";
        
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

$conn->close();
?>
