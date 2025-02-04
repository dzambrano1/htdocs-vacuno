<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_destete table
function insertDestete($conn, $tagid, $peso, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_destete (vh_destete_tagid, vh_destete_peso, vh_destete_fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sds", $tagid, $peso, $fecha);

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
    $peso = isset($_POST['vh_destete_peso']) ? $_POST['vh_destete_peso'] : null;
    $fecha = isset($_POST['vh_destete_fecha']) ? $_POST['vh_destete_fecha'] : null;

    // Call the insert function
    if ($tagid !== null && $peso !== null && $fecha !== null) {
        insertDestete($conn, $tagid, $peso, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 