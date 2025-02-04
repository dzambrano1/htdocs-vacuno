<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_gestacion table
function insertGestacion($conn, $tagid, $numero, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_gestacion (vh_gestacion_tagid, vh_gestacion_numero, vh_gestacion_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sis", $tagid, $numero, $fecha);

    // Execute the statement
    if ($stmt->execute()) {        
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
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null;
    $numero = isset($_POST['vh_gestacion_numero']) ? $_POST['vh_gestacion_numero'] : null;
    $fecha = isset($_POST['vh_gestacion_fecha']) ? $_POST['vh_gestacion_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $numero !== null && $fecha !== null) {
        insertGestacion($conn, $tagid, $numero, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 