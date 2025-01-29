<?php
header('Content-Type: application/json');
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