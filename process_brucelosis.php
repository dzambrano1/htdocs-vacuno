<?php
require_once '../conexion.php';

$conn = new mysqli($servername, $username, $password, $dbname);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Handle delete operation
        if (isset($_POST['id'])) {
            $id = $conn->real_escape_string($_POST['id']);
            $query = "DELETE FROM vh_brucelosis WHERE id = '$id'";
            
            if ($conn->query($query)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'No ID provided']);
        }
    } else {
        // Handle create operation
        $required_fields = ['tagid', 'producto', 'costo', 'dosis', 'fecha'];
        $missing_fields = array_filter($required_fields, function($field) {
            return !isset($_POST[$field]) || empty($_POST[$field]);
        });

        if (!empty($missing_fields)) {
            echo json_encode(['success' => false, 'error' => 'Missing required fields: ' . implode(', ', $missing_fields)]);
            exit;
        }

        $tagid = $conn->real_escape_string($_POST['tagid']);
        $producto = $conn->real_escape_string($_POST['producto']);
        $costo = $conn->real_escape_string($_POST['costo']);
        $dosis = $conn->real_escape_string($_POST['dosis']);
        $fecha = $conn->real_escape_string($_POST['fecha']);

        $query = "INSERT INTO vh_brucelosis (vh_brucelosis_tagid, vh_brucelosis_producto, vh_brucelosis_costo, vh_brucelosis_dosis, vh_brucelosis_fecha) 
                 VALUES ('$tagid', '$producto', '$costo', '$dosis', '$fecha')";

        if ($conn->query($query)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?> 