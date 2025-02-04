<?php

require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_aftosa table
function insertAftosa($conn, $tagid, $producto, $dosis, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_aftosa (vh_aftosa_tagid, vh_aftosa_producto,vh_aftosa_dosis, vh_aftosa_costo, vh_aftosa_fecha) VALUES (?, ?, ?, ?, ?)";
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
    $producto = isset($_POST['vh_aftosa_producto']) ? $_POST['vh_aftosa_producto'] : null;
    $dosis = isset($_POST['vh_aftosa_dosis']) ? $_POST['vh_aftosa_dosis'] : null;
    $costo = isset($_POST['vh_aftosa_costo']) ? $_POST['vh_aftosa_costo'] : null;
    $fecha = isset($_POST['vh_aftosa_fecha']) ? $_POST['vh_aftosa_fecha'] : null;

    // Call the insert function
    if ($tagid && $producto !== null && $costo !== null && $fecha) {
        insertAftosa($conn, $tagid, $producto, $dosis, $costo, $fecha);
    } else {
        echo "Todos los campos son obligatorios";
    }
}

// Close the database connection
$conn->close();
?> 