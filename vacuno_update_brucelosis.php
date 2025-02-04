<?php

require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_brucelosis table
function insertBrucelosis($conn, $tagid, $producto, $dosis, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_brucelosis (vh_brucelosis_tagid, vh_brucelosis_producto,vh_brucelosis_dosis, vh_brucelosis_costo, vh_brucelosis_fecha) VALUES (?, ?, ?, ?, ?)";
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
    $producto = isset($_POST['vh_brucelosis_producto']) ? $_POST['vh_brucelosis_producto'] : null;
    $dosis = isset($_POST['vh_brucelosis_dosis']) ? $_POST['vh_brucelosis_dosis'] : null;
    $costo = isset($_POST['vh_brucelosis_costo']) ? $_POST['vh_brucelosis_costo'] : null;
    $fecha = isset($_POST['vh_brucelosis_fecha']) ? $_POST['vh_brucelosis_fecha'] : null;

    if ($tagid && $producto !== null && $costo !== null && $fecha) {
        insertBrucelosis($conn, $tagid, $producto, $dosis, $costo, $fecha);
    } else {
        echo "Todos los campos son obligatorios";
    }
}

$conn->close();
?> 