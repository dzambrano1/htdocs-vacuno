<?php

require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_aftosa table
function insertIbr($conn, $tagid, $producto, $dosis, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_ibr (vh_ibr_tagid, vh_ibr_producto,vh_ibr_dosis, vh_ibr_costo, vh_ibr_fecha) VALUES (?, ?, ?, ?, ?)";
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

    // Close the statement
    $stmt->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null; // Ensure you pass tagid from the form
    $producto = isset($_POST['vh_ibr_producto']) ? $_POST['vh_ibr_producto'] : null;
    $dosis = isset($_POST['vh_ibr_dosis']) ? $_POST['vh_ibr_dosis'] : null;
    $costo = isset($_POST['vh_ibr_costo']) ? $_POST['vh_ibr_costo'] : null;
    $fecha = isset($_POST['vh_ibr_fecha']) ? $_POST['vh_ibr_fecha'] : null;

    // Call the insert function
    if ($tagid && $producto !== null && $costo !== null && $fecha) {
        insertIbr($conn, $tagid, $producto, $dosis, $costo, $fecha);
    } else {
        echo "Todos los campos son obligatorios";
    }
}

// Close the database connection
$conn->close();
?> 