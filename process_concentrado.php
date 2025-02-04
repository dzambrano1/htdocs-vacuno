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
    $query = "DELETE FROM vh_concentrado WHERE id = '$id'";
    
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
        $producto = $conn->real_escape_string($_POST['producto']);
        $etapa = $conn->real_escape_string($_POST['etapa']);
        $racion = $conn->real_escape_string($_POST['racion']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($racion) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "UPDATE vh_concentrado SET 
                  vh_concentrado_tagid = '$tagid',
                  vh_concentrado_producto = '$producto',
                  vh_concentrado_etapa = '$etapa',
                  vh_concentrado_racion = '$racion',
                  vh_concentrado_costo = '$costo',                  
                  vh_concentrado_fecha = '$fecha'
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
        $etapa = $conn->real_escape_string($_POST['etapa']);
        $racion = $conn->real_escape_string($_POST['racion']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        
        // Validate inputs
        if (!is_numeric($racion) || !is_numeric($costo)) {
            throw new Exception('Invalid input values');
        }
        
        $query = "INSERT INTO vh_concentrado 
                  (vh_concentrado_tagid, vh_concentrado_producto, vh_concentrado_etapa, vh_concentrado_racion, vh_concentrado_costo, vh_concentrado_fecha) 
                  VALUES 
                  ('$tagid','$producto','$etapa','$racion','$costo','$fecha')";
        
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