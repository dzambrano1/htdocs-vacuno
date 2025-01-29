<?php
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

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Handle DELETE requests
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    error_log('Delete request received for ID: ' . $_POST['id']);
    
    $id = $conn->real_escape_string($_POST['id']);
    $query = "DELETE FROM vh_sal WHERE id = '$id'";
    
    error_log('Executing query: ' . $query);
    
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
    $etapa = $conn->real_escape_string($_POST['etapa']);
    $producto = $conn->real_escape_string($_POST['producto']);
    $racion = $conn->real_escape_string($_POST['racion']);
    $costo = $conn->real_escape_string($_POST['costo']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    
    $query = "INSERT INTO vh_sal (vh_sal_tagid, vh_sal_etapa, vh_sal_producto, vh_sal_racion, vh_sal_costo, vh_sal_fecha) 
              VALUES ('$tagid', '$etapa', '$producto', '$racion', '$costo', '$fecha')";
    
    if ($conn->query($query)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

$conn->close();
?> 