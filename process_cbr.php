<?php

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

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Handle delete operation
        if (isset($_POST['id'])) {
            $id = $conn->real_escape_string($_POST['id']);
            $query = "DELETE FROM vh_cbr WHERE id = '$id'";
            
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

        $query = "INSERT INTO vh_cbr (vh_cbr_tagid, vh_cbr_producto, vh_cbr_costo, vh_cbr_dosis, vh_cbr_fecha) 
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