<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_melaza table
function insertMelaza($conn, $tagid, $etapa, $producto, $racion, $costo, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_melaza (vh_melaza_tagid, vh_melaza_etapa, vh_melaza_producto, vh_melaza_racion, vh_melaza_costo, vh_melaza_fecha) VALUES (?, ?, ?, ? , ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sssdds", $tagid, $etapa, $producto, $racion, $costo, $fecha);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to vacuno_tareas.php after successful insert
        header("Location: vacuno_tareas.php?search=" . urlencode($tagid)); // Pass the tagid back to the page
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
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null;
    $etapa = isset($_POST['vh_melaza_etapa']) ? $_POST['vh_melaza_etapa'] : null;
    $producto = isset($_POST['vh_melaza_producto']) ? $_POST['vh_melaza_producto'] : null;
    $racion = isset($_POST['vh_melaza_racion']) ? $_POST['vh_melaza_racion'] : null;
    $costo = isset($_POST['vh_melaza_costo']) ? $_POST['vh_melaza_costo'] : null;
    $fecha = isset($_POST['vh_melaza_fecha']) ? $_POST['vh_melaza_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $etapa !== null && $producto !== null && $racion !== null && $costo !== null && $fecha !== null) {
        insertMelaza($conn, $tagid, $etapa, $producto, $racion,$costo, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 