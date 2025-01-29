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


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_ibr table
function insertCbr($conn, $tagid, $producto, $dosis, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_cbr (vh_cbr_tagid, vh_cbr_producto,vh_cbr_dosis, vh_cbr_costo, vh_cbr_fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("ssdds", $tagid, $producto, $dosis, $costo, $fecha); 

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to vacuno_tareas.php after successful insert
        header("Location: vacuno_tareas.php?search=" . urlencode($tagid));
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null;
    $producto = isset($_POST['vh_cbr_producto']) ? $_POST['vh_cbr_producto'] : null;
    $dosis = isset($_POST['vh_cbr_dosis']) ? $_POST['vh_cbr_dosis'] : null;
    $costo = isset($_POST['vh_cbr_costo']) ? $_POST['vh_cbr_costo'] : null;
    $fecha = isset($_POST['vh_cbr_fecha']) ? $_POST['vh_cbr_fecha'] : null;

    if ($tagid && $producto !== null && $costo !== null && $fecha) {
        insertCbr($conn, $tagid, $producto, $dosis, $costo, $fecha);
    } else {
        echo "Todos los campos son obligatorios";
    }
}

$conn->close();
?> 