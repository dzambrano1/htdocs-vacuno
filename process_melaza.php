<?php

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$conn = new mysqli($servername, $username, $password, $dbname);

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Debug incoming data
error_log("POST data: " . print_r($_POST, true));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Handle delete operation
        if (isset($_POST['id'])) {
            $id = $conn->real_escape_string($_POST['id']);
            $query = "DELETE FROM vh_melaza WHERE id = '$id'";
            
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
        $required_fields = ['tagid', 'etapa', 'producto', 'racion', 'costo', 'fecha'];
        
        // Debug missing fields
        $missing_fields = array_filter($required_fields, function($field) {
            $missing = !isset($_POST[$field]) || empty($_POST[$field]);
            if ($missing) {
                error_log("Missing field: $field");
            }
            return $missing;
        });

        if (!empty($missing_fields)) {
            echo json_encode([
                'success' => false, 
                'error' => 'Missing required fields: ' . implode(', ', $missing_fields),
                'posted_data' => $_POST
            ]);
            exit;
        }

        try {
            $tagid = $conn->real_escape_string($_POST['tagid']);
            $etapa = $conn->real_escape_string($_POST['etapa']);
            $producto = $conn->real_escape_string($_POST['producto']);
            $racion = $conn->real_escape_string($_POST['racion']);
            $costo = $conn->real_escape_string($_POST['costo']);
            $fecha = $conn->real_escape_string($_POST['fecha']);

            $query = "INSERT INTO vh_melaza (
                vh_melaza_tagid, 
                vh_melaza_etapa, 
                vh_melaza_producto, 
                vh_melaza_racion, 
                vh_melaza_costo, 
                vh_melaza_fecha
            ) VALUES (
                '$tagid', 
                '$etapa', 
                '$producto', 
                '$racion', 
                '$costo', 
                '$fecha'
            )";

            if ($conn->query($query)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                throw new Exception($conn->error);
            }
        } catch (Exception $e) {
            error_log("Error in process_melaza.php: " . $e->getMessage());
            echo json_encode([
                'success' => false, 
                'error' => $e->getMessage(),
                'query' => $query ?? 'Query not built'
            ]);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?> 