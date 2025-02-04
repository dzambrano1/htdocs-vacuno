<?php
require_once '../conexion.php';  // Go up one directory since inventario_vacuno.php is in the vacuno folder
// Now you can use $conn for database queries


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert into vh_queso table
function insertqueso($conn, $tagid, $peso, $precio, $fecha) {
    // Prepare the SQL statement
    $query = "INSERT INTO vh_queso (vh_queso_tagid, vh_queso_peso, vh_queso_precio, vh_queso_fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("sdds", $tagid, $peso, $precio, $fecha); // Assuming vh_queso_tagid is a string, and others are decimal

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
    $tagid = isset($_POST['tagid']) ? $_POST['tagid'] : null; // Ensure you pass tagid from the form
    $peso = isset($_POST['vh_queso_peso']) ? $_POST['vh_queso_peso'] : null;
    $precio = isset($_POST['vh_queso_precio']) ? $_POST['vh_queso_precio'] : null;
    $fecha = isset($_POST['vh_queso_fecha']) ? $_POST['vh_queso_fecha'] : null;

    // Call the insert function
    if ($tagid && $peso !== null && $precio !== null && $fecha) {
        insertqueso($conn, $tagid, $peso, $precio, $fecha);
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?> 